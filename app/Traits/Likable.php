<?php

namespace Korona\Traits;

use Korona\Like;
use Korona\User;
use Illuminate\Database\Eloquent\Model;

trait Likable
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }

    public function wasLikedBy(User $user)
    {
        return ($this->likes()->where(['user_id' => $user->id])->count() > 0);
    }
}
