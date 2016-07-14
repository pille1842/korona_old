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
use Cache;
use Carbon\Carbon;
use Parsedown;

class Comment extends Model
{
    use Traits\Likable, Traits\Dislikable;

    /**
     * Definiere die polymorphische Beziehung
     * @return Illuminate\Database\Eloquent\Relations\MorphTo Beziehung
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Definiere die Beziehung zu einem Nutzer
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo Beziehung
     */
    public function user()
    {
        return $this->belongsTo('Korona\User');
    }

    /**
     * Gib den Markdown-formatierten Kommentartext zurück
     *
     * Sucht im Cache nach dem bereits geparsten Kommentar oder erzeugt
     * ihn und gibt das Ergebnis des Parsers zurück
     *
     * @return string Erzeugtes HTML
     */
    public function getFormattedBody()
    {
        return Cache::remember('comments.' . $this->id, 0, function () {
            $parser = new Parsedown();
            $parser->setMarkupEscaped(true);
            return $parser->text($this->body);
        });
    }

    /**
     * Gib den relativen Zeitunterschied seit der Erstellung zurück
     * @return string Nutzerfreundlicher Zeitunterschied
     */
    public function getCreationTimeDifference()
    {
        $carbon = new Carbon($this->created_at);
        $carbon->setLocale(config('app.locale'));
        return $carbon->diffForHumans();
    }

    /**
     * Gib den relativen Zeitunterschied seit der letzten Bearbeitung zurück
     * @return string Nutzerfreundlicher Zeitunterschied
     */
    public function getUpdateTimeDifference()
    {
        $carbon = new Carbon($this->updated_at);
        $carbon->setLocale(config('app.locale'));
        return $carbon->diffForHumans();
    }
}
