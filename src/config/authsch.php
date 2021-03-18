<?php

return [
    'authsch' => [
        'client_id' => '',
        'client_secret' => '',
        'redirect' => 'http://localhost:8000/auth/schonherz/callback',
    ],

    'authsch_scopes' =>[
        "basic",
        "displayName",
        "sn",
        "givenName",
        "mail",
        "linkedAccounts",
        "eduPersonEntitlement",
        "mobile",
        "niifEduPersonAttendedCourse",
        "entrants",
        "admembership",
        "bmeunitscope",
    ],
];
