<?php

namespace Modules\CMS\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use Modules\CMS\Entities\Tag;
use Modules\CMS\Http\Requests\TagFormRequest;
use Modules\CMS\Filters\TagFilters;
use Inertia\Inertia;

class TagController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(TagFormRequest $request)
    {
        $tag = Tag::create([
            'name' => $request->name,
            'slug' => $request->name
        ]);

        if (Request::header('X-Inertia')) {
            return Response::json([
                'tag' => $tag,
            ], 201, [
                'Vary' => 'Accept',
                'X-Inertia' => true,
            ]);
        }

        return $tag;
    }
}
