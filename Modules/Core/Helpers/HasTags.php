<?php

namespace Modules\Core\Helpers;

use Modules\CMS\Entities\Tag;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasTags
{
    /**
     * Define relation of model to tags
     *
     * @return void
     */
    public function tags()
    {
        return $this->tagsRelation;
    }

    /**
     * Sync/Save models tags.
     *
     * @param array $tags
     * @return void
     */
    public function syncTags(array $tags)
    {
        $this->save();
        $this->tagsRelation()->sync($tags);
    }

    /**
     * Remove tags from model.
     *
     * @return void
     */
    public function removeTags()
    {
        $this->tagsRelation()->detach();
    }

    /**
     * Set model morph many relation to tags.
     *
     * @return MorphToMany
     */
    public function tagsRelation(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }
}
