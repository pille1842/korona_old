<?php

namespace Korona\Traits;

use Korona\Comment;
use Illuminate\Database\Eloquent\Model;

trait Commentable
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
