<?php

namespace Korona;

use Illuminate\Database\Eloquent\Model;

class Dislike extends Model
{
    public $timestamps = false;

    public function dislikable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('Korona\User');
    }
}
