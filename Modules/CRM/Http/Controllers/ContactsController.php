<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\CRM\Entities\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Modules\CRM\Filters\ContactFilters;
use Illuminate\Validation\Rule;
use Modules\CRM\Http\Requests\ContactFormRequest;
use Inertia\Inertia;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ContactFilters $filters
     * @return Inertia
     */
    public function index(ContactFilters $filters)
    {
        $perPage = 10;

        return Inertia::render('CRM/Contacts/Index', [
            'perPage' => $perPage,
            'filters' => Request::all('search', 'trashed'),
            'contacts' => Auth::user()->account->contacts()
                ->with('organization')
                ->orderByName()
                ->filter($filters)
                ->paginate($perPage)
                ->transform(function ($contact) {
                    return [
                        'id' => $contact->id,
                        'name' => $contact->name,
                        'phone' => $contact->phone,
                        'city' => $contact->city,
                        'deleted_at' => $contact->deleted_at,
                        'organization' => $contact->organization ? $contact->organization->only('name') : null,
                    ];
                }),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Inertia
     */
    public function create()
    {
        return Inertia::render('CRM/Contacts/Create', [
            'organizations' => Auth::user()->account
                ->organizations()
                ->orderBy('name')
                ->get()
                ->map
                ->only('id', 'name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContactFormRequest $request
     * @return Redirect
     */
    public function store(ContactFormRequest $request)
    {
        $attributes = $this->attributes($request);

        Auth::user()->account->contacts()->create($attributes);

        return Redirect::route('crm.contacts.index')->with('success', 'Contact created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Contact $contact
     * @return Inertia
     */
    public function edit(Contact $contact)
    {
        return Inertia::render('CRM/Contacts/Edit', [
            'contact' => [
                'id' => $contact->id,
                'first_name' => $contact->first_name,
                'last_name' => $contact->last_name,
                'organization_id' => $contact->organization_id,
                'email' => $contact->email,
                'phone' => $contact->phone,
                'address' => $contact->address,
                'city' => $contact->city,
                'region' => $contact->region,
                'country' => $contact->country,
                'postal_code' => $contact->postal_code,
                'deleted_at' => $contact->deleted_at,
            ],
            'organizations' => Auth::user()->account->organizations()
                ->orderBy('name')
                ->get()
                ->map
                ->only('id', 'name'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContactFormRequest $request
     * @param Contact $contact
     * @return Redirect
     */
    public function update(ContactFormRequest $request, Contact $contact)
    {
        $attributes = $this->attributes($request);

        $contact->update($attributes);

        return Redirect::back()->with('success', 'Contact updated.');
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param Contact $contact
     * @return Redirect
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return Redirect::back()->with('success', 'Contact deleted.');
    }

    /**
     * Restore specified resource in storage.
     *
     * @param Contact $contact
     * @return Redirect
     */
    public function restore(Contact $contact)
    {
        $contact->restore();

        return Redirect::back()->with('success', 'Contact restored.');
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
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'organization_id' => $request->organization_id,
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
