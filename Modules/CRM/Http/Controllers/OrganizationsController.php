<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\CRM\Entities\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Modules\CRM\Filters\OrganizationFilters;
use Modules\CRM\Http\Requests\OrganizationFormRequest;
use Inertia\Inertia;

class OrganizationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param OrganizationFilters $filters
     * @return Inertia
     */
    public function index(OrganizationFilters $filters)
    {
        $perPage = 10;

        return Inertia::render('CRM/Organizations/Index', [
            'perPage' => $perPage,
            'filters' => Request::all('search', 'trashed'),
            'organizations' => Auth::user()->account->organizations()
                ->orderBy('name')
                ->filter($filters)
                ->paginate($perPage)
                ->only('id', 'name', 'phone', 'city', 'deleted_at'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Inertia
     */
    public function create()
    {
        return Inertia::render('CRM/Organizations/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrganizationFormRequest $request
     * @return Redirect
     */
    public function store(OrganizationFormRequest $request)
    {
        $attributes = $this->attributes($request);

        Auth::user()->account->organizations()->create($attributes);

        return Redirect::route('crm.organizations.index')->with('success', 'Organization created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Organization $organization
     * @return Inertia
     */
    public function edit(Organization $organization)
    {
        return Inertia::render('CRM/Organizations/Edit', [
            'organization' => [
                'id' => $organization->id,
                'name' => $organization->name,
                'email' => $organization->email,
                'phone' => $organization->phone,
                'address' => $organization->address,
                'city' => $organization->city,
                'region' => $organization->region,
                'country' => $organization->country,
                'postal_code' => $organization->postal_code,
                'deleted_at' => $organization->deleted_at,
                'contacts' => $organization->contacts()->orderByName()->get()->map->only('id', 'name', 'city', 'phone'),
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrganizationFormRequest $request
     * @param Organization $organization
     * @return Redirect
     */
    public function update(OrganizationFormRequest $request, Organization $organization)
    {
        $attributes = $this->attributes($request);

        $organization->update($attributes);

        return Redirect::back()->with('success', 'Organization updated.');
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param Organization $organization
     * @return void
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();

        return Redirect::back()->with('success', 'Organization deleted.');
    }

    /**
     * Restore specified resource in storage.
     *
     * @param Organization $organization
     * @return Redirect
     */
    public function restore(Organization $organization)
    {
        $organization->restore();

        return Redirect::back()->with('success', 'Organization restored.');
    }

    /**
     * Get all attributes
     *
     * @param [type] $request
     * @return array $attributes
     */
    public function attributes($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'region' => $request->region,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
        ];
    }
}
