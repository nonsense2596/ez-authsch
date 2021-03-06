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
                $config = $app['config']['services.authsch'];
                return $socialite->buildProvider(AuthschProvider::class, $config);
            }
        );
    }
}