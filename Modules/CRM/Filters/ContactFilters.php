<?php

namespace Modules\CRM\Filters;

use Modules\Core\Filters\Filters;

class ContactFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['search', 'trashed'];

    /**
     * Filter the query by a given name search query.
     *
     * @param  string $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function search($search)
    {
        return $this->builder->where('first_name', 'like', '%'.$search.'%')
            ->orWhere('last_name', 'like', '%'.$search.'%')
            ->orWhere('email', 'like', '%'.$search.'%')
            ->orWhereHas('organization', function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
        });
    }

    /**
     * Filter the query by with or only trashed.
     *
     * @param  string $trashed
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function trashed($trashed)
    {
        return $this->builder->when($trashed ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }
}
