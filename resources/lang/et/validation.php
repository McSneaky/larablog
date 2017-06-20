<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines - et
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'confirmed'            => 'Paroolid ei kattu.',
    'email'                => 'Väli peab sisaldama e-maili',
    'image'                => 'Failid peavad olema pildid.',
    'max'                  => [
        'numeric' => 'Number ei saa olla suurem kui :max.',
        'file'    => 'Faili maksimum suurus on :max kilobaiti.',
        'string'  => 'Väli ei saa olla pikem kui :max tähemärki.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'Parool peab olema vähemalt :min tähemärki.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'unique'               => 'E-mail on jüba võetud',
    'required'             => 'Väli on kohustuslik.',
];
