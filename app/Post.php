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

    /**
     * Gib die polymorphische Beziehung des Posts zurück
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo Beziehung
     */
    public function postable()
    {
        return $this->morphTo();
    }

    /**
     * Gib die Beziehung des Posts zu einem Nutzer zurück
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Beziehung
     */
    public function user()
    {
        return $this->belongsTo('Korona\User');
    }

    /**
     * Gib den Markdown-formatierten und geparsten Text dieses Posts zurück
     *
     * Prüfe, ob der Cache den geparsten Text bereits vorrätig hat, erzeuge
     * ihn andernfalls und gib das Ergebnis zurück
     *
     * @return string HTML-Quelltext des geparsten Textes
     */
    public function getFormattedBody()
    {
        return Cache::remember('posts.' . $this->id, 0, function () {
            $parser = new Parsedown();
            $parser->setMarkupEscaped(true);
            return $parser->text($this->body);
        });
    }

    /**
     * Gib den relativen Zeitunterschied seit der Erstellung zurück
     * @return string nutzerfreundlicher Zeitunterschied
     */
    public function getCreationTimeDifference()
    {
        $carbon = new Carbon($this->created_at);
        $carbon->setLocale(config('app.locale'));
        return $carbon->diffForHumans();
    }

    /**
     * Gib den relativen Zeitunterschied seit der letzten Bearbeitung zurück
     * @return string nutzerfreundlicher Zeitunterschied
     */
    public function getUpdateTimeDifference()
    {
        $carbon = new Carbon($this->updated_at);
        $carbon->setLocale(config('app.locale'));
        return $carbon->diffForHumans();
    }

    /**
     * Berühre diesen Post, um ihn in der Timeline nach oben zu rücken
     *
     * Setze den "touched_at"-Zeitstempel dieses Posts auf Jetzt, z.B.
     * bei Erstellung eines neuen Kommentars, um ihn in der Liste der Posts
     * nach oben zu rücken
     *
     * @return void
     */
    public function touch()
    {
        $this->touched_at = Carbon::now();
    }

    /**
     * Berühre diesen Post und speichere ihn in der Datenbank
     * @param  array  $options Optionen
     * @return boolean         Ergebnis des Speichervorgangs
     */
    public function save(array $options = [])
    {
        $this->touch();
        return parent::save($options);
    }

    /**
     * Gib die URL dieses Models zurück
     * @return string URL
     */
    public function getUrl()
    {
        return action('PostController@show', $this);
    }
}
