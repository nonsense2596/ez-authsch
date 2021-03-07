<?php

//declare(strict_types=1);

namespace nonsense2596\AuthschSocialite;

use Exception;
use Illuminate\Support\Arr;
use GuzzleHttp\ClientInterface;
use Laravel\Socialite\Two\User;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;

class AuthschProvider extends AbstractProvider implements ProviderInterface
{
    protected $scopes;

    protected $scopeSeparator = ' ';

    public function __construct(Request $request, $clientId, $clientSecret, $redirectUrl, $guzzle = [])
    {
        $this->guzzle = $guzzle;
        $this->request = $request;
        $this->clientId = $clientId;
        $this->redirectUrl = $redirectUrl;
        $this->clientSecret = $clientSecret;

        $this->scopes = config('services.authsch_scopes');
    }

    protected function getAuthUrl($state){ 
        return $this->buildAuthUrlFromBase('https://auth.sch.bme.hu/' . '/site/login', $state);
    }

    protected function getTokenUrl(){   
        return "https://auth.sch.bme.hu/oauth2/token";
    }

    protected function getUserByToken($token){
        $userUrl = 'https://auth.sch.bme.hu' . '/api/profile?access_token=' . $token;
        $response = $this->getHttpClient()->get($userUrl);
        return json_decode($response->getBody(), true);
    }

 
    protected function mapUserToObject(array $user){
        ddd($user);
    }

}