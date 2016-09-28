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

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Traits\Postable;

    /**
     * Versteckte Attribute des Models
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Gib die Beziehung dieses Nutzers zu einem Mitglied zurück
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function member()
    {
        return $this->hasOne('Korona\Member');
    }

    /**
     * Gib den generischen Namen dieses Models zurück
     *
     * Für die Anzeige von Posts und die Verlinkung des gemorphten Objekts ist
     * es notwendig, dass das Objekt einen generischen Namen hat, der dem Nutzer
     * angezeigt werden kann. In diesem Fall wird der Nickname (Biername) des
     * mit diesem Nutzer assoziierten Mitglieds zurückgegeben.
     *
     * @return string generischer Name
     */
    public function getGenericName()
    {
        return $this->member->getShortName();
    }

    /**
     * Gib die URL dieses Models zurück
     * @return string URL
     */
    public function getUrl()
    {
        return url('/u/' . $this->handle);
    }
}
