<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Helpers\HasSlug;
use Modules\CMS\Filters\TagFilters;

class Tag extends Model
{
    use HasFactory;
    use HasSlug;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cms_tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Tag id
     *
     * @return $id
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * A tag belongs to many articles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany('Modules\CMS\Entities\Article', 'cms_article_tags');
    }

    /**
     * Apply all relevant tag filters.
     *
     * @param  Builder       $query
     * @param  TagFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, TagFilters $filters)
    {
        return $filters->apply($query);
    }
}
