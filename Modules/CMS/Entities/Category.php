<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Kalnoy\Nestedset\NodeTrait;
use Modules\Core\Helpers\HasSlug;

class Category extends Model
{
    use HasFactory;
    use NodeTrait;
    use HasSlug;

    protected $table = 'cms_categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'published',
    ];

    protected $appends = [
        'category_image_path',
    ];

    public function id()
    {
        return $this->id;
    }

    public function articles()
    {
        return $this->hasMany('Modules\CMS\Entities\Articles');
    }

    public function parentCategory()
    {
        return $this->belongsTo('Modules\CMS\Entities\Category', 'parent_id', 'id');
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%'.$query.'%')
                ->orWhere('description', 'like', '%'.$query.'%');
    }

    public function getCategoryImagePathAttribute()
    {
        return $this->image ? Storage::disk('public')->url($this->image) : '';
    }

    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }
}
