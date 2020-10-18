<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Modules\Core\Http\Requests\RoleFormRequest;
use Inertia\Inertia;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Inertia
     */
    public function index()
    {
        $perPage = 10;

        $roles = Role::paginate($perPage);

        return Inertia::render('Admin/Role/Index', [
            'filters' => Request::all('search'),
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Inertia
     */
    public function create()
    {
        $permissions = Permission::all('id', 'name');

        return Inertia::render('Admin/Role/Create', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleFormRequest $request
     * @return Redirect
     */
    public function store(RoleFormRequest $request)
    {
        $role = Role::create($request->only('name', 'guard_name'));

        // Attach permissions
        if(!empty($request->permissions))
        {
            $role->syncPermissions($request->permissions);
        }

        return redirect(route('admin.roles.index'))->with('success', 'Role created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return Inertia
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all('id', 'name');

        return Inertia::render('Admin/Role/Edit', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleFormRequest $request
     * @param Role $role
     * @return Redirect
     */
    public function update(RoleFormRequest $request, Role $role)
    {
        $role->update($request->only('name', 'guard_name'));

        // Attach permissions
        if(!empty($request->permissions))
        {
            $role->syncPermissions($request->permissions);
        }

        return redirect(route('admin.roles.index'))->with('success', 'Role updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return Redirect
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect(route('admin.roles.index'))->with('success', 'Role deleted.');
    }
}
