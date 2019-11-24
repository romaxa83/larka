<?php

namespace Tests\Traits;

trait JsonStructure
{
    public function structureStandart()
    {
        return [
            'data',
            'success'
        ];
    }

    public function structureBearer()
    {
        return [
            'data' => [
                'token_type',
                'expires_in',
                'access_token',
                'refresh_token',
                'success'
            ],
            'success'
        ];
    }

    public function structureNotValid($fieldsName) : array
    {
        return [
            'message',
            'errors' => [
                'fields' => is_array($fieldsName) ? $fieldsName : [$fieldsName],
                'success'
            ]
        ];
    }
}