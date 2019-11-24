<?php

namespace App\Repositories;

use DB;

class OAuthRepository
{
    /**
     * @param $userId
     * @return mixed
     * @throws \Exception
     */
    public function getClientIdBySecret($secret)
    {
        if(!$id = DB::select('SELECT id FROM oauth_clients WHERE secret = ?',[$secret])){
            throw new \Exception("Not found raw in 'oauth_clients'");
        }

        return $id[0]->id;
    }
}