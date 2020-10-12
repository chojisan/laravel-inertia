<?php

namespace Modules\Core\Helpers;

use Illuminate\Support\Str;

trait HasSlug
{
    /**
     * Define the slug field of the model.
     *
     * @return string
     */
    public function slug(): string
    {
        return $this->slug;
    }

    /**
     * Set the value for slug attribute.
     *
     * @param string $slug
     * @return void
     */
    public function setSlugAttribute(string $slug)
    {
        $this->attributes['slug'] = $this->generateUniqueSlug($slug);
    }

    /**
     * Find the slug if exist on the model
     *
     * @param string $slug
     * @return self
     */
    public static function findBySlug(string $slug): self
    {
        return static::where('slug', $slug)->firstOrFail();
    }

    /**
     * Generate unique slug
     *
     * @param string $value
     * @return string
     */
    private function generateUniqueSlug(string $value): string
    {
        $slug = $originalSlug = Str::slug($value) ?: Str::random(5);
        $counter = 0;

        while ($this->slugExists($slug, $this->exists ? $this->id() : null)) {
            $counter++;
            $slug = $originalSlug . '-' . $counter;
        }

        return $slug;
    }

    /**
     * Check if the slug exists on the model.
     *
     * @param string $slug
     * @param integer $ignoreId
     * @return boolean
     */
    private function slugExists(string $slug, int $ignoreId = null): bool
    {
        $query = $this->where('slug', $slug);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->count();
    }
}
