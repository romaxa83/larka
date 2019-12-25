<?php

namespace App\Socket;


use Workerman\Worker;

class WorkermanServer
{
    public static function start()
    {
        $worker = new \Workerman\Worker('websocket://0.0.0.0:8080');
        $worker->count = 4;

        $worker->onConnect = function($connection){
            $connection->send('message');
        };

        Worker::runAll();
    }
}