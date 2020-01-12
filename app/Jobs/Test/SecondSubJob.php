<?php

namespace App\Jobs\Test;

use App\Models\Books\Category;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SecondSubJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function handle()
    {
        // генерируеи ошибку
        throw new Exception('Some Error',101);

        logs()->info($this->message);
    }

    // метод обрабатывает провалившиеся задачи
    public function failed(Exception $exception)
    {
        logs()->info(__CLASS__ . ": ошибка выполненияю");
    }
}