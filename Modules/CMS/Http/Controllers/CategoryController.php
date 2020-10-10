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
     * @return Renderable
     */
    public function index(CategoryFilters $filters)
    {
        $perPage = 10;

        return Inertia::render('CMS/Categories/Index', [
            'perPage' => $perPage,
            'filters' => Request::all('search'),
            'categories' => Category::with('parentCategory')
                    ->filter($filters)
                    ->paginate($perPage)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories = Category::published()->get();

        traverseFlatten($categories->toTree(), 'name');

        return Inertia::render('CMS/Categories/Create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
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
     * @param int $id
     * @return Renderable
     */
    public function edit(Category $category)
    {
        $categories = Category::published()->get();

        traverseFlatten($categories->toTree(), 'name');

        return Inertia::render('CMS/Categories/Edit', ['categories' => $categories, 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(CategoryFormRequest $request, Category $category)
    {
        $attributes = $this->attributes($request);

        $attributes = $this->uploadImage($request, $attributes);

        $category->update($attributes);

        return redirect(route('cms.categories.index'))->with('success', 'Category updated.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect(route('cms.categories.index'))->with('success', 'Category deleted.');
    }

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
