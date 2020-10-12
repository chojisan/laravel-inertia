<?php

namespace Modules\Core\Helpers;

use Modules\Core\Entities\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasAuthor
{
    /**
     * Set author relation to model.
     *
     * @return User
     */
    public function author(): User
    {
        return $this->authorRelation;
    }

    /**
     * Associate author to model.
     *
     * @param User $author
     * @return void
     */
    public function authoredBy(User $author)
    {
        $this->authorRelation()->associate($author);
    }

    /**
     * Set model belongs to user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function authorRelation(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get model data that belong to user.
     *
     * @param User $user
     * @return boolean
     */
    public function isAuthoredBy(User $user): bool
    {
        return $this->author()->matches($user);
    }
}
