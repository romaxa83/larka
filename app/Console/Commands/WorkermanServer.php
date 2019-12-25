<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WorkermanServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wm:server {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start Workerman server for notification by socket';

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
     * @see https://github.com/walkor/Workerman
     *
     * @return mixed
     */
    public function handle()
    {
        switch ($this->argument('action')) {
            case 'start':
                $this->startServer();

                break;
            case 'stop':
                $this->stopServer();

                break;
            case 'status':
                $this->getServerStatus();

                break;
            default:
                $this->error($this->argument('action') . ' action does not exist, try one one thoses : start, stop, status');
                break;
        }
    }

    /**
     * Start SocketIO server.
     */
    protected function startServer()
    {
        \App\Socket\WorkermanServer::start();
    }

//    /**
//     * Stop SocketIO server.
//     */
//    protected function stopServer()
//    {
//        LaravelWorkermanServer::stop();
//    }
//
//    /**
//     * Get SocketIO server status.
//     */
//    protected function getServerStatus()
//    {
//        $status = LaravelWorkermanServer::getStatus();
//
//        $this->info($status);
//    }
}