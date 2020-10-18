<?php

namespace Modules\CMS\Policies;

use App\Models\User;
use Modules\CMS\Entities\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user, Article $article)
    {
        return $article->isAuthoredBy($user);
    }

     /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  Modules\CMS\Entities\Article  $article
     * @return mixed
     */
    public function view(User $user, Article $article)
    {
        return $article->isAuthoredBy($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  Modules\CMS\Entities\Article  $article
     * @return mixed
     */
    public function update(User $user, Article $article)
    {
        return $article->isAuthoredBy($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  Modules\CMS\Entities\Article  $article
     * @return mixed
     */
    public function delete(User $user, Article $article)
    {
        return $article->isAuthoredBy($user);
    }
}
