<?php

namespace Modules\CMS\Filters;

use Modules\Core\Filters\Filters;
use App\Models\User;

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
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
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
