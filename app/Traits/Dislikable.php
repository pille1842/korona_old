<?php

namespace Korona\Traits;

use Korona\Dislike;
use Korona\User;
use Illuminate\Database\Eloquent\Model;

trait Dislikable
{
    public function dislikes()
    {
        return $this->morphMany(Dislike::class, 'dislikable');
    }

    public function wasDislikedBy(User $user)
    {
        return ($this->dislikes()->where(['user_id' => $user->id])->count() > 0);
    }
}
