<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Helpers\HasAuthor;
use Modules\Core\Helpers\HasSlug;
use Modules\CMS\Filters\ArticleFilters;

class Article extends Model
{
    use HasFactory;
    use HasAuthor;
    use HasSlug;

    /**
     * Statuses.
     */
    const STATUS_PUBLISHED = 'PUBLISHED';
    const STATUS_DRAFT = 'DRAFT';
    const STATUS_PENDING = 'PENDING';

    /**
     * List of statuses.
     *
     * @var array
     */
    public static $statuses = [
        ["value" => self::STATUS_PUBLISHED, "name" => self::STATUS_PUBLISHED],
        ["value" => self::STATUS_DRAFT, "name" => self::STATUS_DRAFT],
        ["value" => self::STATUS_PENDING, "name" => self::STATUS_PENDING]
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cms_articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_id',
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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'article_image_path',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['authorRelation', 'category', 'tags'];

    /**
     * Article id
     *
     * @return $id
     */
    public function id()
    {
        return $this->id;
    }

     /**
     * An article belongs to a category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('Modules\CMS\Entities\Category');
    }

     /**
     * An article has many tags.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongstoMany('Modules\CMS\Entities\Tag', 'cms_article_tags');
    }

    /**
     * Get a string path for the article.
     *
     * @return string
     */
    public function path()
    {
        return "/articles/{$this->category->slug}/{$this->slug}";
    }

    /**
     * Access the article image path
     *
     * @return string
     */
    public function getArticleImagePathAttribute()
    {
        return $this->image ? Storage::disk('public')->url($this->image) : '';
    }

    /**
     * Apply all relevant article filters.
     *
     * @param  Builder       $query
     * @param  ArticleFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, ArticleFilters $filters)
    {
        return $filters->apply($query);
    }

    /**
     * Filter all published articles.
     *
     * @param  Builder       $query
     * @return Builder
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'PUBLISHED');
    }
}
