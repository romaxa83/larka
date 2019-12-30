<?php

namespace App\Services;

use App\Repositories\OAuthRepository;
use App\Repositories\UserRepository;
use DB;
use GuzzleHttp\Client;

class DashboardService
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

    public function checkNodeSocketServer()
    {
        $http = new Client();
        $host = env('NODE_SOCKET_HOST') . ':' . env('NODE_SOCKET_PORT');

        $response = $http->post($host);
dd($response);
        return json_decode((string) $response->getBody(), true);
    }


}