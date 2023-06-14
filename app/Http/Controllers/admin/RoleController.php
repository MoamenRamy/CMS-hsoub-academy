<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{

    public $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->role::all();

        return view('admin.roles.all', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $role = $this->role;

        $role->role = $request->name;

        $role->save();

        return back()->with('success', 'تم اضافه الدور بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->role->find($id)->delete();

        return back()->with('success', 'تم حذف الدور بنجاح');
    }

    public function getByRole(Request $data)
    {
        $permission = $this->role->find($data->id)->permissions()->pluck('permission_id');

        return $permission;
    }
}
