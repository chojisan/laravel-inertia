<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Kalnoy\Nestedset\NodeTrait;
use Modules\Core\Helpers\HasSlug;
use Modules\CMS\Filters\CategoryFilters;

class Category extends Model
{
    use HasFactory;
    use NodeTrait;
    use HasSlug;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cms_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'published',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'category_image_path',
    ];

    /**
     * Category id
     *
     * @return $id
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * A category has many articles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('Modules\CMS\Entities\Articles');
    }

    /**
     * A category belongs to a parent category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentCategory()
    {
        return $this->belongsTo('Modules\CMS\Entities\Category', 'parent_id', 'id');
    }


    /**
     * Access the category image path
     *
     * @return string
     */
    public function getCategoryImagePathAttribute()
    {
        return $this->image ? Storage::disk('public')->url($this->image) : '';
    }

    /**
     * Apply all relevant category filters.
     *
     * @param  Builder       $query
     * @param  CategoryFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, CategoryFilters $filters)
    {
        return $filters->apply($query);
    }

    /**
     * Filter all published categories.
     *
     * @param  Builder       $query
     * @return Builder
     */
    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }
}
