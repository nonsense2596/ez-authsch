<?php

declare(strict_types=1);

namespace nonsense2596\AuthschSocialite;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class AuthschSocialiteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'authsch',
            function($app) use ($socialite){
                $config = $app['config']['authsch.authsch'];
                return $socialite->buildProvider(AuthschProvider::class, $config);
            }
        );

        // ----------------======== VIEW ========----------------
        // ez ha innen akarjuk loadolni, es akkor "namespace::viewnev" a view meghivasa
        //$this->loadViewsFrom(__DIR__.'/../resources/views', 'authsch');
        // ez meg ha jobban modositani akarjuk, anelkul, hogy egy esetleges frissites ne modositsa a dolgokat
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/Authsch'),
        ],'views');

        // ----------------======== CONTROLLERS ========----------------
        $this->publishes([
            __DIR__.'/Controllers' => app_path('Http/Controllers/Authsch'),
        ],'controllers');

        // ----------------======== CONFIG ========----------------
        $this->publishes([
            __DIR__.'/../config/authsch.php' => config_path('authsch.php'),
        ],'config');

        // ----------------======== MODELS ========----------------
        $this->publishes([
            __DIR__.'/Models' => app_path('Models/Authsch'),
        ],'models');

        // ----------------======== MIGRATIONS ========----------------
        // ha csak betoltse a migraciokat innen a "php artisan migrate" parancs futtatasakor
        //$this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('/migrations'),
        ],'migrations');

    }
}
