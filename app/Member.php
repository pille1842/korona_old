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

class Member extends Model
{
    /**
     * Gib den bürgerlichen Namen zurück
     *
     * @return string
     */
    public function getCivilName()
    {
        return $this->replaceNamePattern(config('app.patterns.civil_name'));
    }

    /**
     * Gib den vollständigen Namen (inkl. Spitz-/Biernamen) zurück
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->replaceNamePattern(config('app.patterns.full_name'));
    }

    /**
     * Ersetze in einer Musterzeichenkette Teile des Namens des Nutzers
     *
     * @param  string $pattern Musterzeichenkette, in der %F durch den Vornamen, %L durch den Nachnamen
     *                         und %N durch den Spitznamen (Biernamen) ersetzt wird
     * @return string
     */
    public function replaceNamePattern($pattern)
    {
        $name = $pattern;
        $name = str_replace('%F', $this->firstname, $name);
        $name = str_replace('%L', $this->lastname, $name);
        $name = str_replace('%N', $this->nickname, $name);
        return $name;
    }

    /**
     * Gib den mit diesem Mitglied assoziierten Nutzer zurück
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Korona\User');
    }

    /**
     * Gib den Leibbursch dieses Mitglieds zurück
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function leibbursch()
    {
        return $this->belongsTo('Korona\Member', 'leibbursch_id');
    }

    /**
     * Gib die Leibfüchse dieses Mitglieds zurück
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leibfuechse()
    {
        return $this->hasMany('Korona\Member', 'leibbursch_id');
    }
}