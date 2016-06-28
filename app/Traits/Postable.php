<?php

namespace Korona\Traits;

use Korona\Post;
use Illuminate\Database\Eloquent\Model;

trait Postable
{
    public function posts()
    {
        return $this->morphMany(Post::class, 'postable');
    }
}
