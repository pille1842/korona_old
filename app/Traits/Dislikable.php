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