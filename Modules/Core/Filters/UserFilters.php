<?php

namespace Modules\Core\Filters;

use Modules\Core\Filters\Filters;

class UserFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['username', 'name'];

    /**
     * Filter the query by a given name query. Either first name or last name
     *
     * @param  string $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function name($name)
    {
        return $this->builder->where('first_name', 'like', "%{$name}%" )
                            ->orWhere('last_name', 'like', "%{$name}%" );
    }

    /**
     * Filter the query by a given username.
     *
     * @param  string $username
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function username($username)
    {
        return $this->builder->where('username', $username);
    }
}
