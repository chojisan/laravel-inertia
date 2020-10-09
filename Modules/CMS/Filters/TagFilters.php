<?php

namespace Modules\CMS\Filters;

use Modules\Core\Filters\Filters;

class TagFilters extends Filters
{
    protected $filters = ['search', 'name'];

    public function search($search)
    {
        return $this->builder->where('name', 'like', "%{$search}%" );
    }

    public function name($name)
    {
        return $this->builder->where('name', $name);
    }
}
