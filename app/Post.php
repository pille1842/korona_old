<?php 
/*
 * Korona - A free community management system for German-language fraternities
 * Copyright (C) 2016 Eric Haberstroh <eric@erixpage.de>
 *
 * This file is part of Korona.
 *
 * Korona is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Korona is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Korona.  If not, see <http://www.gnu.org/licenses/>.
 */


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