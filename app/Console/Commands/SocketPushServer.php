<?php

namespace App\Console\Commands;

use App\Socket\PusherSocket;
use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Wamp\WampServer;
use React\EventLoop\Factory as ReactLoop;
use React\ZMQ\Context as ReactContext;
use React\Socket\Server as ReactServer;

class SocketPushServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'socket-push-server:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start server for notification by socket';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Запуск сервера который будет прослушивать клиента для получения данных
     *
     * @return mixed
     */
    public function handle()
    {
        $loop = ReactLoop::create();

        /** @var $pusher PusherSocket класс который будет работать с данными - формировать, обрабатывать, отправлять*/
        $pusher = new PusherSocket;

        $context = new ReactContext($loop);

        $pull = $context->getSocket(\ZMQ::SOCKET_PULL);
        // ловим на этом канале данные, которые туда прокидывает PusherSocket
        $pull->bind("tcp://127.0.0.1:5555");
        // на событие "message" , обрабатывать буде класс PusherSocket и метод в нем broadcast
        $pull->on('message',[$pusher, 'broadcast']);

        // Поднимаем сервер, который будет отдавать информацию подписавшимся на нее клиентам
        $webSock = new ReactServer('tcp://192.168.126.102:8080',$loop);
//        $webSock->listen(8080, '0.0.0.0');
        $webServer = new IoServer(new HttpServer(new WsServer(new WampServer($pusher))), $webSock);

        $this->info('Run handle');

        $loop->run();
    }
}
