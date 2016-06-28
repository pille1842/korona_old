<?php

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
     * Gib das mit diesem Nutzerkonto assoziierte Mitglied zurück
     *
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
        return $this->member->nickname;
    }

    /**
     * Gib die URL dieses Models zurück
     * 
     * @return string URL
     */
    public function getUrl()
    {
        return url('/u/' . $this->handle);
    }
}
