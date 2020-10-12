<?php

namespace Modules\CMS\Filters;

use Modules\Core\Filters\Filters;

class TagFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['search', 'name'];

    /**
     * Filter the query by a given search query.
     *
     * @param  string $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function search($search)
    {
        return $this->builder->where('name', 'like', "%{$search}%" );
    }

    /**
     * Filter the query by tag name.
     *
     * @param  string $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function name($name)
    {
        return $this->builder->where('name', $name);
    }
}
