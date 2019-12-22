<?php

namespace App\Socket;

use ZMQContext;

class PusherSocket extends BasePusher
{
    /**
     * Отправляем данные в App\Console\Commands\SocketPushServer который
     * затем обратиться сюда же (в обьект PusherSocket)(в указаный метод)
     * для того чтобы данные ретранслировать подписчикам
     *
     * можно использовать из любой точки приложения
     */
    public static function sentDataToServer(array $data)
    {
        $context = new ZMQContext();
        $socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'my pusher');

        $socket->connect("tcp://127.0.0.1:5555");

        $data = json_encode($data);

        $socket->send($data);
    }

    /**
     * Рассылает подписчикам данные
     */
    public function broadcast($jsonDataToSend)
    {
        $aDataToSend = json_decode($jsonDataToSend, true);

        $subscribedTopics = $this->getSubscribedTopics();

        if(isset($subscribedTopics[$aDataToSend['topic_id']])){

            $topic = $subscribedTopics[$aDataToSend['topic_id']];
            $topic->broadcast($aDataToSend);
        }
    }

}