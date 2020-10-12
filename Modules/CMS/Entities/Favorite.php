<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'cms_favorites';

    protected $fillable = [
        'user_id',
        'favorited_id',
        'favorited_type'
    ];

    public function favorited()
    {
        return $this->morphTo();
    }
}
