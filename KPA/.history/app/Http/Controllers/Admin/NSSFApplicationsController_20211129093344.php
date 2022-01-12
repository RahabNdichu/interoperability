<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyKpaApplicationRequest;
use App\Http\Requests\StoreKpaApplicationRequest;
use App\Http\Requests\UpdateKpaApplicationRequest;
use App\NSSF;
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

        $nssf = new NSSF::get();
        // $defaultStatus    = Status::find(1);
        // $user             = auth()->user();

        return view('admin.nssf.index', compact('nssf'));
    }

    public function create()
    {
        abort_if(Gate::denies('nssf_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kpaApplications.create');
    }

    public function store(StoreKpaApplicationRequest $request)
    {
        // $kpaApplication = KpaApplication::create($request->only('kpa_amount', 'description'));

        return redirect()->route('admin.kpa-applications.index');
    }

    public function edit(NSSF $kpaApplication)
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

    public function update(UpdateKpaApplicationRequest $request, NSSF $kpaApplication)
    {
        $kpaApplication->update($request->only('kpa_amount', 'description', 'status_id'));

        return redirect()->route('admin.kpa-applications.index');
    }

    public function show(NSSF $kpaApplication)
    {
        abort_if(Gate::denies('nssf_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kpaApplication->load('status', 'analyst', 'cfo', 'created_by', 'logs.user', 'comments');
        $defaultStatus = Status::find(1);
        $user          = auth()->user();
        // $logs          = AuditLogService::generateLogs($kpaApplication);

        return view('admin.kpaApplications.show', compact('kpaApplication', 'defaultStatus', 'user', 'logs'));
    }

    public function destroy(NSSF $kpaApplication)
    {
        abort_if(Gate::denies('nssf_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kpaApplication->delete();

        return back();
    }

    public function massDestroy(MassDestroyKpaApplicationRequest $request)
    {
        NSSF::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
