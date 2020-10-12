<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Request;
use Illuminate\Routing\Controller;
use Modules\CMS\Entities\Tag;
use Modules\CMS\Http\Requests\TagFormRequest;
use Modules\CMS\Filters\TagFilters;
use Inertia\Inertia;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param TagFilters $filters
     * @return Inertia
     */
    public function index(TagFilters $filters)
    {
        $perPage = 10;

        return Inertia::render('CMS/Tags/Index', [
            'perPage' => $perPage,
            'filters' => Request::all('search'),
            'tags' => Tag::filter($filters)
                    ->paginate($perPage)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Inertia
     */
    public function create()
    {
        return Inertia::render('CMS/Tags/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagFormRequest $request
     * @return Redirect
     */
    public function store(TagFormRequest $request)
    {
        $tag = Tag::create([
            'name' => $request->name,
            'slug' => $request->name
        ]);

        return redirect(route('cms.tags.index'))->with('success', 'Contact created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tag $tag
     * @return Inertia
     */
    public function edit(Tag $tag)
    {
        return Inertia::render('CMS/Tags/Edit', ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagFormRequest $request
     * @param Tag $tag
     * @return Redirect
     */
    public function update(TagFormRequest $request, Tag $tag)
    {
        $tag->update([
            'name' => $request->name,
            'slug' => $request->name
        ]);

        return redirect(route('cms.tags.index'))->with('success', 'Tag updated.');
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param Tag $tag
     * @return Redirect
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect(route('cms.tags.index'))->with('success', 'Tag deleted.');
    }
}
