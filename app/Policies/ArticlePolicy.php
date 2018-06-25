<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Article;
use App\User;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Article $article)
    {
        if($article->user_id == $user->id) {

            return true;
        }

        return false;
    }


    public function delete(User $user, Article $article)
    {
        if($article->user_id == $user->id) {

            return true;
        }

        return false;
    }
}
