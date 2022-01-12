<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyKpaApplicationRequest;
use App\Http\Requests\StoreKpaApplicationRequest;
use App\Http\Requests\UpdateKpaApplicationRequest;
use App\;
use App\Role;
use App\Services\AuditLogService;
use App\Status;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class NSSFApplicationsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('nssf_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nssf = NSSF::get();
        $defaultStatus    = Status::find(1);
        $user             = auth()->user();

        return view('admin.kpaApplications.index', compact('kpaApplications', 'defaultStatus', 'user'));
    }

    public function create()
    {
        abort_if(Gate::denies('nssf_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kpaApplications.create');
    }

    public function store(StoreKpaApplicationRequest $request)
    {
        $kpaApplication = KpaApplication::create($request->only('kpa_amount', 'description'));

        return redirect()->route('admin.kpa-applications.index');
    }

    public function edit(KpaApplication $kpaApplication)
    {
        abort_if(
            Gate::denies('nssf_edit') || !in_array($kpaApplication->status_id, [6,7]),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $statuses = Status::whereIn('id', [1, 8, 9])->pluck('name', 'id');

        $kpaApplication->load('status');

        return view('admin.kpaApplications.edit', compact('statuses', 'kpaApplication'));
    }

    public function update(UpdateKpaApplicationRequest $request, KpaApplication $kpaApplication)
    {
        $kpaApplication->update($request->only('kpa_amount', 'description', 'status_id'));

        return redirect()->route('admin.kpa-applications.index');
    }

    public function show(KpaApplication $kpaApplication)
    {
        abort_if(Gate::denies('nssf_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kpaApplication->load('status', 'analyst', 'cfo', 'created_by', 'logs.user', 'comments');
        $defaultStatus = Status::find(1);
        $user          = auth()->user();
        $logs          = AuditLogService::generateLogs($kpaApplication);

        return view('admin.kpaApplications.show', compact('kpaApplication', 'defaultStatus', 'user', 'logs'));
    }

    public function destroy(KpaApplication $kpaApplication)
    {
        abort_if(Gate::denies('nssf_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kpaApplication->delete();

        return back();
    }

    public function massDestroy(MassDestroyKpaApplicationRequest $request)
    {
        KpaApplication::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function showSend(KpaApplication $kpaApplication)
    {
        abort_if(!auth()->user()->is_admin, Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($kpaApplication->status_id == 1) {
            $role = 'Analyst';
            $users = Role::find(3)->users->pluck('name', 'id');
        } else if (in_array($kpaApplication->status_id, [3,4])) {
            $role = 'CFO';
            $users = Role::find(4)->users->pluck('name', 'id');
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        return view('admin.kpaApplications.send', compact('kpaApplication', 'role', 'users'));
    }

    public function send(Request $request, KpaApplication $kpaApplication)
    {
        abort_if(!auth()->user()->is_admin, Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($kpaApplication->status_id == 1) {
            $column = 'analyst_id';
            $users  = Role::find(3)->users->pluck('id');
            $status = 2;
        } else if (in_array($kpaApplication->status_id, [3,4])) {
            $column = 'cfo_id';
            $users  = Role::find(4)->users->pluck('id');
            $status = 5;
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $request->validate([
            'user_id' => 'required|in:' . $users->implode(',')
        ]);

        $kpaApplication->update([
            $column => $request->user_id,
            'status_id' => $status
        ]);

        return redirect()->route('admin.kpa-applications.index')->with('message', 'kpa application has been sent for analysis');
    }

    public function showAnalyze(KpaApplication $kpaApplication)
    {
        $user = auth()->user();

        abort_if(
            (!$user->is_analyst || $kpaApplication->status_id != 2) && (!$user->is_cfo || $kpaApplication->status_id != 5),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        return view('admin.kpaApplications.analyze', compact('kpaApplication'));
    }

    public function analyze(Request $request, KpaApplication $kpaApplication)
    {
        $user = auth()->user();

        if ($user->is_analyst && $kpaApplication->status_id == 2) {
            $status = $request->has('approve') ? 3 : 4;
        } else if ($user->is_cfo && $kpaApplication->status_id == 5) {
            $status = $request->has('approve') ? 6 : 7;
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $request->validate([
            'comment_text' => 'required'
        ]);

        $kpaApplication->comments()->create([
            'comment_text' => $request->comment_text,
            'user_id'      => $user->id
        ]);

        $kpaApplication->update([
            'status_id' => $status
        ]);

        return redirect()->route('admin.kpa-applications.index')->with('message', 'Analysis has been submitted');
    }
}
