<?php

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
