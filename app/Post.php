<?php

namespace Korona;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Cache;
use Parsedown;

class Post extends Model
{
    use Traits\Likable, Traits\Dislikable, Traits\Commentable;

    public function postable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('Korona\User');
    }

    public function getFormattedBody()
    {
        return Cache::remember('posts.' . $this->id, 0, function () {
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

    public function touch()
    {
        $this->touched_at = Carbon::now();
    }

    public function save(array $options = [])
    {
        $this->touch();
        return parent::save($options);
    }
}
