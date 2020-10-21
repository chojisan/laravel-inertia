<?php

namespace Modules\Core\Http\Controllers;

use Modules\Core\Http\Controllers\CoreController as Controller;
use Illuminate\Support\Facades\Request;
use Modules\Core\Entities\User;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Inertia
     */
    public function index()
    {
        $perPage = 10;

        $users = User::paginate($perPage);

        return Inertia::render('Admin/User/Index', [
            'filters' => Request::all('search'),
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return Inertia::render('Admin/User/Create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(User $user)
    {
        return Inertia::render('Admin/User/Edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Redirect
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect(route('admin.users.index'))->with('success', 'User deleted.');
    }

    /**
     * Restore specified resource in storage.
     *
     * @param User $user
     * @return Redirect
     */
    public function restore(User $user)
    {
        $user->restore();

        return redirect(route('admin.users.index'))->with('success', 'User restored.');
    }
}
