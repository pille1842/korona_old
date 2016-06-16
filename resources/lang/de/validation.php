<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute muss akzeptiert werden.',
    'active_url'           => ':attribute ist keine gültige URL.',
    'after'                => ':attribute muss ein Datum nach :date sein.',
    'alpha'                => ':attribute darf nur Buchstaben enthalten.',
    'alpha_dash'           => ':attribute darf nur Buchstaben, Zahlen und Bindestriche enthalten.',
    'alpha_num'            => ':attribute darf nur Buchstaben und Zahlen enthalten.',
    'array'                => ':attribute muss ein Array sein.',
    'before'               => ':attribute muss ein Datum vor :date sein.',
    'between'              => [
        'numeric' => ':attribute muss zwischen :min und :max liegen.',
        'file'    => ':attribute muss zwischen :min und :max Kilobytes groß sein.',
        'string'  => ':attribute muss zwischen :min und :max Zeichen lang sein.',
        'array'   => ':attribute muss zwischen :min und :max Elementen haben.',
    ],
    'boolean'              => ':attribute muss entweder WAHR oder FALSCH sein.',
    'confirmed'            => ':attribute stimmt nicht mit dem Bestätigungsfeld überein.',
    'date'                 => ':attribute ist kein gültiges Datum.',
    'date_format'          => ':attribute entspricht nicht dem Format :format.',
    'different'            => ':attribute und :other müssen sich unterscheiden.',
    'digits'               => ':attribute muss :digits Ziffern haben.',
    'digits_between'       => ':attribute muss zwischen :min und :max Ziffern haben.',
    'dimensions'           => ':attribute hat eine unzulässige Bildgröße.',
    'distinct'             => ':attribute enthält einen doppelten Wert.',
    'email'                => ':attribute muss eine gültige E-Mail-Adresse sein.',
    'exists'               => ':attribute enthält eine ungültige Auswahl.',
    'filled'               => ':attribute muss ausgefüllt werden.',
    'image'                => ':attribute muss ein Bild sein.',
    'in'                   => ':attribute enthält eine ungültige Auswahl.',
    'in_array'             => ':attribute existiert nicht in :other.',
    'integer'              => ':attribute muss eine ganze Zahl sein.',
    'ip'                   => ':attribute muss eine gültige IP-Adresse sein.',
    'json'                 => ':attribute muss eine gültige JSON-Zeichenkette sein.',
    'max'                  => [
        'numeric' => ':attribute darf nicht größer als :max sein.',
        'file'    => ':attribute darf nicht größer als :max Kilobytes sein.',
        'string'  => ':attribute darf nicht länger als :max Zeichen sein.',
        'array'   => ':attribute darf nicht mehr als :max Elemente haben.',
    ],
    'mimes'                => ':attribute muss eine Datei mit einem der folgenden Typen sein: :values.',
    'min'                  => [
        'numeric' => ':attribute muss mindestens :min sein.',
        'file'    => ':attribute muss mindestens :min Kilobytes groß sein.',
        'string'  => ':attribute muss mindestens :min Zeichen lang sein.',
        'array'   => ':attribute muss mindestens :min Elemente haben.',
    ],
    'not_in'               => ':attribute enthält eine ungültige Auswahl.',
    'numeric'              => ':attribute muss eine Zahl sein.',
    'present'              => ':attribute muss eingegeben werden.',
    'regex'                => ':attribute entspricht nicht dem geforderten Format.',
    'required'             => ':attribute muss eingegeben werden.',
    'required_if'          => ':attribute muss eingegeben werden, wenn :other den Wert :value hat.',
    'required_unless'      => ':attribute muss eingegeben werden, solange :other nicht einen der Werte :values hat.',
    'required_with'        => ':attribute muss eingegeben werden, wenn :values eingegeben wird.',
    'required_with_all'    => ':attribute muss eingegeben werden, wenn :values eingegeben werden.',
    'required_without'     => ':attribute muss eingegeben werden, wenn :values nicht vorhanden ist.',
    'required_without_all' => ':attribute muss eingegeben werden, wenn nichts von :values eingegeben wird.',
    'same'                 => ':attribute und :other müssen übereinstimmen.',
    'size'                 => [
        'numeric' => ':attribute muss :size sein.',
        'file'    => ':attribute muss :size Kilobytes groß sein.',
        'string'  => ':attribute muss :size Zeichen lang sein.',
        'array'   => ':attribute muss :size Elemente enthalten.',
    ],
    'string'               => ':attribute muss eine Zeichenkette sein.',
    'timezone'             => ':attribute muss eine gültige Zeitzone sein.',
    'unique'               => ':attribute ist bereits vergeben.',
    'url'                  => ':attribute entspricht nicht dem geforderten Format.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
