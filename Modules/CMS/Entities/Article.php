<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Helpers\HasAuthor;
use Modules\Core\Helpers\HasSlug;

class Article extends Model
{
    use HasFactory;
    use HasAuthor;
    use HasSlug;

    protected $table = 'cms_articles';

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'image',
        'short_description',
        'description',
        'featured',
        'hits',
        'meta_description',
        'meta_keywords',
        'order',
        'status'
    ];

    public function id()
    {
        return $this->id;
    }

    public function category()
    {
        return $this->belongsTo('Modules\CMS\Entities\Category');
    }

    public function tags()
    {
        return $this->belongstoMany('Modules\CMS\Entities\Tag', 'cms_article_tags');
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('title', 'like', '%'.$query.'%')
                ->orWhere('description', 'like', '%'.$query.'%');
    }

    public function getArticleImagePathAttribute()
    {
        return $this->image ? Storage::disk('public')->url($this->image) : '';
    }
}
