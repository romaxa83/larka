<?php
namespace App\Providers;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class ElasticServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Client::class, function (Application $app) {
            $config = $app->make('config')->get('elastic');

            return ClientBuilder::create()
                ->setHosts([$config['connections']['host'] .':'. $config['connections']['port']])
                ->setRetries($config['retries'])
                ->build();
        });
    }
}