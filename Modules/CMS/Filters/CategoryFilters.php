<?php

namespace Modules\CMS\Filters;

use Modules\Core\Filters\Filters;

class CategoryFilters extends Filters
{
    protected $filters = ['search', 'name', 'description'];

    public function search($search)
    {
        return $this->builder->where('name', 'like', "%{$search}%" )
                            ->orWhere('name', 'like', "%{$search}%" );
    }

    public function name($name)
    {
        return $this->builder->where('name', 'like', "%{$title}%" );
    }

    public function description($description)
    {
        return $this->builder->where('description', 'like', "%{$description}%" );
    }
}
