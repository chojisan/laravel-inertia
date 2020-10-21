<?php

namespace Modules\CMS\Filters;

use Modules\Core\Filters\Filters;

class CategoryFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['search', 'name', 'description'];

    /**
     * Filter the query by a given search query. Either name or description
     *
     * @param  string $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function search($search)
    {
        return $this->builder->where('name', 'like', "%{$search}%" )
                            ->orWhere('description', 'like', "%{$search}%" );
    }

    /**
     * Filter the query by category name.
     *
     * @param  string $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function name($name)
    {
        return $this->builder->where('name', 'like', "%{$name}%" );
    }

    /**
     * Filter the query by category description.
     *
     * @param  string $description
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function description($description)
    {
        return $this->builder->where('description', 'like', "%{$description}%" );
    }
}
