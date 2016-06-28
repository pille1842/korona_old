<?php

namespace Korona;

use Illuminate\Database\Eloquent\Model;
use Cache;
use Carbon\Carbon;
use Parsedown;

class Comment extends Model
{
    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('Korona\User');
    }

    public function getFormattedBody()
    {
        return Cache::remember('comments.' . $this->id, 0, function () {
            $parser = new Parsedown();
            return $parser->text($this->body);
        });
    }

    public function getCreationTimeDifference()
    {
        $carbon = new Carbon($this->created_at);
        $carbon->setLocale(config('app.locale'));
        return $carbon->diffForHumans();
    }

    public function getUpdateTimeDifference()
    {
        $carbon = new Carbon($this->updated_at);
        $carbon->setLocale(config('app.locale'));
        return $carbon->diffForHumans();
    }
}
