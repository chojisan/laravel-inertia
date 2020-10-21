<?php

namespace Modules\CMS\Policies;

use Modules\Core\Entities\User;
use Modules\CMS\Entities\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @param Article $article
     * @return boolean
     */
    public function viewAny(User $user, Article $article)
    {
        return $article->isAuthoredBy($user);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Article $article
     * @return boolean
     */
    public function view(User $user, Article $article)
    {
        return $article->isAuthoredBy($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return boolean
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Article $article
     * @return boolean
     */
    public function update(User $user, Article $article)
    {
        return $article->isAuthoredBy($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Article $article
     * @return boolean
     */
    public function delete(User $user, Article $article)
    {
        return $article->isAuthoredBy($user);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Article $article
     * @return boolean
     */
    public function restore(User $user, Article $article)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Article $article
     * @return boolean
     */
    public function forceDelete(User $user, Article $article)
    {
        //
    }
}
