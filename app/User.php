<?php

namespace Korona;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * Gebe den bürgerlichen Namen zurück
     *
     * @return string
     */
    public function getCivilName()
    {
        return $this->replaceNamePattern(config('app.patterns.civil_name'));
    }

    /**
     * Gebe den vollständigen Namen (inkl. Spitz-/Biernamen) zurück
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
     *                            und %N durch den Spitznamen (Biernamen) ersetzt wird
     * @return string
     */
    public function replaceNamePattern($pattern)
    {
        $name = str_replace('%F', $this->firstname, $name);
        $name = str_replace('%L', $this->lastname, $name);
        $name = str_replace('%N', $this->nickname, $name);
        return $name;
    }
}
