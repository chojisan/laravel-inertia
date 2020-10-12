<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Request;
use Illuminate\Routing\Controller;
use Modules\CMS\Entities\Category;
use Modules\CMS\Http\Requests\CategoryFormRequest;
use Modules\CMS\Filters\CategoryFilters;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CategoryFilters $filters
     * @return Inertia
     */
    public function index(CategoryFilters $filters)
    {
        $perPage = 10;

        return Inertia::render('CMS/Categories/Index', [
            'perPage' => $perPage,
            'filters' => Request::all('search'),
            'categories' => Category::withDepth()->defaultOrder()->with('parentCategory')
                    ->filter($filters)
                    ->paginate($perPage)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Inertia
     */
    public function create()
    {
        $categories = Category::published()->defaultOrder()->get();

        traverseFlatten($categories->toTree(), 'name');

        return Inertia::render('CMS/Categories/Create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryFormRequest $request
     * @return Redirect
     */
    public function store(CategoryFormRequest $request)
    {
        $attributes = $this->attributes($request);

        $attributes = $this->uploadImage($request, $attributes);

        $category = Category::create($attributes);

        return redirect(route('cms.categories.index'))->with('success', 'Category created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Inertia
     */
    public function edit(Category $category)
    {
        $categories = Category::published()->defaultOrder()->get();

        traverseFlatten($categories->toTree(), 'name');

        return Inertia::render('CMS/Categories/Edit', ['categories' => $categories, 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryFormRequest $request
     * @param Category $category
     * @return Redirect
     */
    public function update(CategoryFormRequest $request, Category $category)
    {
        $attributes = $this->attributes($request);

        $attributes = $this->uploadImage($request, $attributes);

        $category->update($attributes);

        return redirect(route('cms.categories.index'))->with('success', 'Category updated.');
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param Category $category
     * @return Redirect
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect(route('cms.categories.index'))->with('success', 'Category deleted.');
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
            'slug' => $request->name,
            'parent_id' => $request->parent_id ?: 0,
            'description' => $request->description,
            'published' => $request->published ?: 0,
        ];
    }

    /**
     * Upload image if it exists and append path to attribute
     *
     * @param [type] $request
     * @param Array $attributes
     * @return array $attributes
     */
    public function uploadImage($request, $attributes)
    {
        if ($request->image)
        {
            $image = $request->file('image')->store('cms/categories', 'public');

            $attributes = array_merge($attributes, ['image' => $image]);
        }

        return $attributes;
    }
}
