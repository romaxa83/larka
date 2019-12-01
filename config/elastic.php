<?php

use Illuminate\Support\Str;

return [

    'connections' => [
        'host' => env('ELASTIC_HOST', '127.0.0.1'),
        'port' => env('ELASTIC_PORT', '9200'),
    ],
    // кол-во обращение
    'retries' => 1
];
