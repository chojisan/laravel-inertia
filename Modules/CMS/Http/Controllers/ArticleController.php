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
    public $options = [["value" => "PUBLISHED", "name" => "PUBLISHED"], ["value" => "DRAFT", "name" => "DRAFT"], ["value" => "PENDING", "name" => "PENDING"]];

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ArticleFilters $filters)
    {
        $perPage = 10;

        return Inertia::render('CMS/Articles/Index', [
            'perPage' => $perPage,
            'filters' => Request::all('search'),
            'articles' => Auth::user()->articles()
                    ->with('user', 'category')
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
        $categories = Category::all('id', 'name');
        $tags = Tag::all('id', 'name');

        return Inertia::render('CMS/Articles/Create', [
            'tags' => $tags,
            'categories' => $categories,
            'options' => collect($this->options)]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
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
     * @param int $id
     * @return Renderable
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
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ArticleFormRequest $request, Article $article)
    {
        $attributes = $this->attributes($request);

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

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect(route('cms.articles.index'))->with('success', 'Article deleted.');
    }

    public function attributes($request)
    {
        $user = auth()->id();

        return [
            'user_id' => $user,
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
