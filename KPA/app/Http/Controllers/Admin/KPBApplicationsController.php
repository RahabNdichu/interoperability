<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyKpaApplicationRequest;
use App\Http\Requests\StoreKpaApplicationRequest;
use App\Http\Requests\UpdateKpaApplicationRequest;
use App\KPB;
use App\Role;
use App\Services\AuditLogService;
use App\Status;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class KPBApplicationsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kpb_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kpb = KPB::with('user')->get();

        return view('admin.kpb.index', compact('kpb'));
    }
}
