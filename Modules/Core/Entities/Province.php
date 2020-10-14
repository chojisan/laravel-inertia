<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'region_id',
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
        'region_id'
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
     * Collection of cities under this Province.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function cities()
    {
        return $this->morphMany(City::class, 'geographic');
    }

    /**
     * Collection of municipalities under this Province.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }

    /**
     * This Province belongs to a Region
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
