<?php

namespace App\Services;

use App\Repositories\OAuthRepository;
use App\Repositories\UserRepository;
use DB;
use GuzzleHttp\Client;

class OAuthService
{
    /**
     * @var OAuthRepository
     */
    private $authRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(OAuthRepository $authRepository, UserRepository $userRepository)
    {
        $this->authRepository = $authRepository;
        $this->userRepository = $userRepository;
    }

    public function getBearerToken($password, $email)
    {
        $clientSecret = config('auth.oauth_secret_key');
        $clientId = $this->authRepository->getClientIdBySecret($clientSecret);
//var_dump($email);die();
        $http = new Client();

        $response = $http->post(env('APP_URL') . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'username' => $email,
                'password' => $password,
                'scope' => '*',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function getRefreshToken($refreshToken)
    {
        $clientSecret = config('auth.oauth_secret_key');
        $clientId = $this->authRepository->getClientIdBySecret($clientSecret);

        $http = new Client();

        $response = $http->post(env('APP_URL') . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'scope' => '*'
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }
}