# ez-authsch

A Laravel socialite oauth2 module for authsch (https://auth.sch.bme.hu/)

install with this:
```
composer require nonsense2596/ez-authsch
```

publish the package files to your project folder:

```
php artisan vendor:publish
```
and choose the number of the "nonsense2596/ez-authsch" package

edit the scopes you want to use in config/authsch.php


list of possible scopes:
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

create the required database tables for ez-authsch:

```
php artisan migrate
```
---
to run a demo page, that displays all possible information of the logged in user @ the "ip:port/user" route
add the following to the web.php file
```
Route::group(['middleware' => 'web'], function (){
    Route::get('/user',[UserController::class,'index'])->middleware('auth');
});
```

also, example routes for the login, callback and logout functions

```
Route::get('/auth/schonherz', [SocialController::class, 'schonherzRedirect'])->name('login');
Route::get('/auth/schonherz/callback', [SocialController::class, 'loginWithSchonherz']);
Route::get('/auth/schonherz/logout',[SocialController::class, 'logOutOfSchonFuckingHerz']);
```


