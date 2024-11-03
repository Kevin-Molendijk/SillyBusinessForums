<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    public function toggleHidden(User $user, Post $post)
    {
        return $user->isAdmin() || $user->id === $post->user_id;
    }

}
