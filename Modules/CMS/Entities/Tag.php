<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Helpers\HasSlug;

class Tag extends Model
{
    use HasFactory;
    use HasSlug;

    protected $table = 'cms_tags';

    protected $fillable = [
        'name',
        'slug',
    ];

    public function article()
    {
        return $this->belongsToMany('Modules\CMS\Entities\Article', 'cms_article_tags');
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%'.$query.'%');
    }
}
