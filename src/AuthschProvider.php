<?php

namespace nonsense2596\AuthschSocialite;

use Exception;
use Illuminate\Http\Request;
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

        $this->scopes = config('authsch.authsch_scopes');
    }

    protected function getAuthUrl($state){
        return $this->buildAuthUrlFromBase('https://auth.sch.bme.hu/site/login', $state);
    }

    protected function getTokenUrl(){
        return "https://auth.sch.bme.hu/oauth2/token";
    }

    protected function getUserByToken($token){
        $userUrl = 'https://auth.sch.bme.hu/api/profile?access_token=' . $token;
        $response = $this->getHttpClient()->get($userUrl);
        return json_decode($response->getBody(), true);
    }

    protected function mapUserToObject(array $user){
        return (new User())->setRaw($user)->map([
            'id'                            => Arr::get($user,'internal_id'),
            'displayName'                   => Arr::get($user,'displayName',null),
            'sn'                            => Arr::get($user,'sn',null),
            'givenName'                     => Arr::get($user,'givenName',null),
            'mail'                          => Arr::get($user,'mail',null),
            'linkedAccounts'                => Arr::get($user,'linkedAccounts',null),
            'eduPersonEntitlement'          => Arr::get($user,'eduPersonEntitlement',null),
            'mobile'                        => Arr::get($user,'mobile',null),
            'niifEduPersonAttendedCourse'   => Arr::get($user,'niifEduPersonAttendedCourse',null),
            'entrants'                      => Arr::get($user,'entrants',null),
            'admembership'                  => Arr::get($user,'admembership',null),
            'bmeunitscope'                  => Arr::get($user,'bmeunitscope',null),
            'permanentaddress'              => Arr::get($user,'permanentaddress',null),
            'birthdate'                     => Arr::get($user,'birthdate',null),
        ]);
    }

}
