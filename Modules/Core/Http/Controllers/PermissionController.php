<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Modules\Core\Http\Requests\PermissionFormRequest;
use Inertia\Inertia;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Inertia
     */
    public function index()
    {
        $perPage = 10;

        $permissions = Permission::paginate($perPage);

        return Inertia::render('Admin/Permission/Index', [
            'filters' => Request::all('search'),
            'permissions' => $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Inertia
     */
    public function create()
    {
        return Inertia::render('Admin/Permission/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PermissionFormRequest $request
     * @return Redirect
     */
    public function store(PermissionFormRequest $request)
    {
        $permission = Permission::create($request->only('name', 'guard_name'));

        return redirect(route('admin.permissions.index'))->with('success', 'Permission created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Permission $permission
     * @return Inertia
     */
    public function edit(Permission $permission)
    {
        return Inertia::render('Admin/Permission/Edit', [
            'permission' => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PermissionFormRequest $request
     * @param Permission $permission
     * @return Redirect
     */
    public function update(PermissionFormRequest $request, Permission $permission)
    {
        $permission->update($request->only('name', 'guard_name'));

        return redirect(route('admin.permissions.index'))->with('success', 'Permission updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @return Redirect
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect(route('admin.permissions.index'))->with('success', 'Permission deleted.');
    }
}
