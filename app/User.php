<?php

namespace Korona;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * Versteckte Attribute des Models
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Gib das mit diesem Nutzerkonto assoziierte Mitglied zurück
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function member()
    {
        return $this->hasOne('Korona\Member');
    }
}
