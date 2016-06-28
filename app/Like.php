<?php

namespace Korona;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $timestamps = false;

    public function likable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('Korona\User');
    }
}
