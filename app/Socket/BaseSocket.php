<?php

namespace App\Socket;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class BaseSocket implements MessageComponentInterface
{

    /**
     * событие отрабатывает когда открываеться новое соединение
     * @throws \Exception
     */
    function onOpen(ConnectionInterface $conn)
    {
        // TODO: Implement onOpen() method.
    }

    /**
     * событие, когда соединение закрываеться
     * @throws \Exception
     */
    function onClose(ConnectionInterface $conn)
    {
        // TODO: Implement onClose() method.
    }

    /**
     * событие, когда произошла ошибка
     * @param  ConnectionInterface $conn
     * @param  \Exception $e
     * @throws \Exception
     */
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        // TODO: Implement onError() method.
    }

    /**
     * событие, когда с клиента приходит сообщение на сервер
     * @param  \Ratchet\ConnectionInterface $from The socket/connection that sent the message to your application
     * @param  string $msg The message received
     * @throws \Exception
     */
    function onMessage(ConnectionInterface $from, $msg)
    {
        // TODO: Implement onMessage() method.
    }
}