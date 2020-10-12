<?php

namespace Modules\CRM\Entities;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class Model extends Eloquent
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Set view per page value.
     *
     * @var integer
     */
    protected $perPage = 10;

    /**
     * Fix route model binding with trashed values.
     *
     * @param [type] $value
     * @param [type] $field
     * @return void
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return in_array(SoftDeletes::class, class_uses($this))
            ? $this->where($this->getRouteKeyName(), $value)->withTrashed()->first()
            : parent::resolveRouteBinding($value);
    }
}
