<?php

namespace Modules\CRM\Entities;

use Modules\CRM\Entities\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CRM\Entities\Organization;
use Modules\CRM\Filters\ContactFilters;

class Contact extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'crm_contacts';

    /**
     * A contact belongs to organizations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Belongsto
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Get the  full name. Concat first_name and last_name
     *
     * @return void
     */
    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * Set order by last_name and first_name.
     *
     * @param [type] $query
     * @return void
     */
    public function scopeOrderByName($query)
    {
        $query->orderBy('last_name')->orderBy('first_name');
    }

    /**
     * Apply all relevant organization filters.
     *
     * @param  Builder       $query
     * @param  ContactFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, ContactFilters $filters)
    {
        return $filters->apply($query);
    }
}
