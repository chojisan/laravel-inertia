<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Helpers\HasAuthor;
use Modules\CMS\Traits\Favoritable;
use Carbon\Carbon;

class Reply extends Model
{
    use HasAuthor;
    use Favoritable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cms_replies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'body'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['authorRelation', 'favorites'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['favoritesCount', 'isFavorited'];

    /**
     * Boot the reply instance.
     */
    protected static function boot()
    {
        parent::boot();

        /* static::created(function ($reply) {
            $reply->article->increment('replies_count');
        });

        static::deleted(function ($reply) {
            $reply->article->decrement('replies_count');
        }); */
    }

    /**
     * A reply belongs to article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Determine if the reply was just published a moment ago.
     *
     * @return bool
     */
    public function wasJustPublished()
    {
        return $this->created_at->gt(Carbon::now()->subMinute());
    }

    /**
     * Fetch all mentioned users within the reply's body.
     *
     * @return array
     */
    public function mentionedUsers()
    {
        preg_match_all('/@([\w\-]+)/', $this->body, $matches);

        return $matches[1];
    }

    /**
     * Determine the path to the reply.
     *
     * @return string
     */
    public function path()
    {
        return $this->article->path() . "#reply-{$this->id}";
    }

    /**
     * Set the body attribute.
     *
     * @param string $body
     */
    public function setBodyAttribute($body)
    {
        $this->attributes['body'] = preg_replace(
            '/@([\w\-]+)/',
            '<a href="/profiles/$1">$0</a>',
            $body
        );
    }

    /**
     * Access the body attribute.
     *
     * @param  string $body
     * @return string
     */
    public function getBodyAttribute($body)
    {
        return \Purify::clean($body);
    }
}
