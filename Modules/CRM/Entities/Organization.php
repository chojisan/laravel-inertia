<?php

namespace Modules\CRM\Entities;

use Modules\CRM\Entities\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CRM\Filters\OrganizationFilters;

class Organization extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'crm_organizations';

    /**
     * An organization has many contacts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * Apply all relevant organization filters.
     *
     * @param  Builder       $query
     * @param  OrganizationFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, OrganizationFilters $filters)
    {
        return $filters->apply($query);
    }
}
