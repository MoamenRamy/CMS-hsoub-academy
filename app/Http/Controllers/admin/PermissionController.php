<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = $this->permission->all();

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Role::find($request->role_id)->permissions()->sync($request->permission);

        return back()->with('success', 'تم حفظ الصلاحيات الجديده');
    }

}
