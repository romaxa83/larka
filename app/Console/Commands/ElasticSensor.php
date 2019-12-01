<?php

namespace App\Console\Commands;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class ElasticSensor extends Command
{
    protected $signature = 'elastic:sensor {action : create|show|delete}';

    protected $description = 'Create index for sensor';

    protected $action;
    /**
     * The configs for this package.
     *
     * @var array
     */
    protected $config;

    private $client;

    public function __construct(Client $client)
    {
        parent::__construct();

        $this->client = $client;
    }

    public function handle()
    {
        $this->loadConfigs();
        $this->initAction();
        $this->runAction();

    }

    protected function create()
    {
        $this->client->indices()->create([
            'index' => 'sensors',
            'body' => [
                'mappings' => [
                    'sensor' => [
                        '_source' => [
                            'enabled' => true
                        ],
                        'properties' => [
                            'id' => [
                                'type' => 'integer'
                            ],
                            'title' => [
                                'type' => 'text',
                            ],
                        ]
                    ]
                ]
            ]
        ]);

    }

    protected function show()
    {
        dd($this->client->ping());
    }

    protected function delete()
    {
        dd($this->action);
    }

    protected function runAction()
    {
        $this->{$this->action}();
    }

    protected function loadConfigs()
    {
        $this->config = $this->laravel->make('config')->get('elastic');
    }

    protected function initAction()
    {
        $this->action = $this->argument('action');
        if (! in_array($this->action, ['create', 'delete', 'show'], true)) {
            $this->error(
                "Invalid argument '{$this->action}'. Expected 'start', 'stop', 'restart', 'reload' or 'infos'."
            );
            return;
        }
    }
}