# ez-authsch

install with this:
```
composer require nonsense2596/ez-authsch
```

add the following lines to config / services.php

```
    'authsch' => [
        'client_id' => 'asdasdsda',
        'client_secret' => 'asdasdsecretasdsad',
        'redirect' => 'http://localhost:8000/auth/schomething/callback', 
    ],
```

and also the scopes you want to use

```
    'authsch_scopes' => [
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
```

finally run the command
```
php artisan vendor:publish
```
to automatically publish the required helper views and controllers to your laravel main directories
