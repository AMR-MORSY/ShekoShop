<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleUpdateRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return view('pages.admin.RolesOrPermissions', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('pages.admin.RoleOrPermissionForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $validated = $request->validated();

        $role = Role::create(["name" => $validated["name"], "guard_name" => "web"]);

        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        
        $permissions=$role->permissions()->pluck('name');
        return view('pages.admin.viewRole',['role'=>$role,'permissions'=>$permissions]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
       
        $permissions=$role->permissions;
        $allPermissions=Permission::all();
        $availablepermissions=$allPermissions->diff($permissions)->toArray();
        // dd($availablePermissions);
       
       
        return view('pages.admin.editRole',['role'=>$role,'permissions'=>$permissions,'availablepermissions'=>$availablepermissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        $validated=$request->validated();
        $role->syncPermissions($validated["permissions"]);
        return response()->json([
            'redirect' => route('role.show',['role'=>$role->id])
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json([
            'redirect' => route('role.index')
        ], 200);
    }
}
