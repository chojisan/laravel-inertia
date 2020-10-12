<?php

namespace Modules\CMS\Filters;

use Modules\Core\Filters\Filters;
use Modules\Core\Entities\User;

class ArticleFilters extends Filters
{
    protected $filters = ['search', 'by', 'title', 'description'];

    public function search($search)
    {
        return $this->builder->where('title', 'like', "%{$search}%" )
                            ->orWhere('description', 'like', "%{$search}%" );
    }

    public function by($username)
    {
        $user = User::where('first_name', 'like', "%{$username}%" )
                        ->orWhere('last_name', 'like', "%{$username}%" )
                        ->firstOrFail();

        return $this->builder->where('author_id', $user->id);
    }

    public function title($title)
    {
        return $this->builder->where('title', 'like', "%{$title}%" );
    }

    public function description($description)
    {
        return $this->builder->where('description', 'like', "%{$description}%" );
    }
}
