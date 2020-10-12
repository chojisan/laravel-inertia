<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Routing\Controller;
use Modules\CMS\Entities\Article;
use Modules\CMS\Entities\Category;
use Modules\CMS\Entities\Tag;
use Modules\CMS\Http\Requests\ArticleFormRequest;
use Modules\CMS\Filters\ArticleFilters;
use Inertia\Inertia;
use Illuminate\Support\Arr;

class ArticleController extends Controller
{
    /**
     * List of option for article status
     *
     * @var array
     */
    public $options = [["value" => "PUBLISHED", "name" => "PUBLISHED"], ["value" => "DRAFT", "name" => "DRAFT"], ["value" => "PENDING", "name" => "PENDING"]];

    /**
     * Display a listing of the resource.
     *
     * @param ArticleFilters $filters
     * @return Inertia
     */
    public function index(ArticleFilters $filters)
    {
        $perPage = 10;

        return Inertia::render('CMS/Articles/Index', [
            'perPage' => $perPage,
            'filters' => Request::all('search'),
            'articles' => Article::filter($filters)
                    ->paginate($perPage)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Inertia
     */
    public function create()
    {
        $categories = Category::all('id', 'name');
        $tags = Tag::all('id', 'name');

        return Inertia::render('CMS/Articles/Create', [
            'tags' => $tags,
            'categories' => $categories,
            'options' => collect($this->options)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleFormRequest $request
     * @return Redirect
     */
    public function store(ArticleFormRequest $request)
    {
        $attributes = $this->attributes($request);

        $attributes = $this->uploadImage($request, $attributes);

        $article = Article::create($attributes);

        // Attach tags
        if(!empty($request->tags))
        {
            $tags = Arr::pluck($request->tags, 'id');
            $article->tags()->sync($tags);
        }

        return redirect(route('cms.articles.index'))->with('success', 'Article created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return Inertia
     */
    public function edit(Article $article)
    {
        $categories = Category::all('id', 'name');
        $tags = Tag::all('id', 'name');

        return Inertia::render('CMS/Articles/Edit', [
            'article' => $article,
            'tags' => $tags,
            'categories' => $categories,
            'options' => collect($this->options)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleFormRequest $request
     * @param Article $article
     * @return Redirect
     */
    public function update(ArticleFormRequest $request, Article $article)
    {
        $attributes = $this->attributes($request);

        // Remove author
        $attributes = Arr::except($attributes, ['author_id']);

        $attributes = $this->uploadImage($request, $attributes);

        $article->update($attributes);

        // Attach tags
        if(!empty($request->tags))
        {
            $tags = Arr::pluck($request->tags, 'id');
            $article->tags()->sync($tags);
        } else {
            $article->tags()->detach();
        }

        return redirect(route('cms.articles.index'))->with('success', 'Article updated.');
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param Article $article
     * @return Redirect
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect(route('cms.articles.index'))->with('success', 'Article deleted.');
    }

    /**
     * Get all attributes
     *
     * @param [type] $request
     * @return array $attributes
     */
    public function attributes($request)
    {
        $user = auth()->id();

        return [
            'author_id' => $user,
            'title' => $request->title,
            'slug' => $request->title,
            'featured' => $request->featured ?: 0,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'status' => $request->status,
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
            $image = $request->file('image')->store('cms/articles', 'public');

            $attributes = array_merge($attributes, ['image' => $image]);
        }

        return $attributes;
    }
}
