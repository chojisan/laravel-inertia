<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'province_id',
        'name',
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
        'province_id'
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
     * Collection of barangays under this municipality.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function barangays()
    {
        return $this->morphMany(Barangay::class, 'geographic');
    }

    /**
     * Municipality belongs to a Province.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
