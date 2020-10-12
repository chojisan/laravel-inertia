<?php

namespace Modules\CMS\Filters;

use Modules\Core\Filters\Filters;
use Modules\Core\Entities\User;

class ArticleFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['search', 'by', 'title', 'description'];

    /**
     * Filter the query by a given search query. Either title or description
     *
     * @param  string $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function search($search)
    {
        return $this->builder->where('title', 'like', "%{$search}%" )
                            ->orWhere('description', 'like', "%{$search}%" );
    }

    /**
     * Filter the query by a given name. Either first name or last name
     *
     * @param  string $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function by($name)
    {
        $user = User::where('first_name', 'like', "%{$name}%" )
                        ->orWhere('last_name', 'like', "%{$name}%" )
                        ->firstOrFail();

        return $this->builder->where('author_id', $user->id);
    }

    /**
     * Filter the query by article title.
     *
     * @param  string $title
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function title($title)
    {
        return $this->builder->where('title', 'like', "%{$title}%" );
    }

    /**
     * Filter the query by article description.
     *
     * @param  string $description
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function description($description)
    {
        return $this->builder->where('description', 'like', "%{$description}%" );
    }
}
