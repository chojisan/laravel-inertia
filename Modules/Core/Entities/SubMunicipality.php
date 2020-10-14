<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class SubMunicipality extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'city_id',
        'name',
        'population'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'city_id'
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
     * Collection of barangays under this sub municipality.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function barangays()
    {
        return $this->morphMany(Barangay::class, 'geographic');
    }

    /**
     * This SubMunicipality belongs to a City
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
