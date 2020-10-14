<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'geographic_type',
        'geographic_id',
        'name',
        'city_class',
        'income_class',
        'population'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'geographic_type',
        'geographic_id'
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'code';
    }

    /**
     * Province or District that this city belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function geographic()
    {
        return $this->morphTo();
    }

    /**
     * Collection of sub municipalities under this city.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subMunicipalities()
    {
        return $this->hasMany(SubMunicipality::class);
    }

    /**
     * Collection of barangays under this city.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function barangays()
    {
        return $this->morphMany(Barangay::class, 'geographic');
    }
}
