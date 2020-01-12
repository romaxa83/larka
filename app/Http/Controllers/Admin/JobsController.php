<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\Test\FirstSubJob;
use App\Jobs\Test\MainJob;
use App\Jobs\Test\SecondSubJob;

class JobsController extends Controller
{

    public function run()
    {
        MainJob::withChain([
            new FirstSubJob('Run First Sub Job'),
            new SecondSubJob('Run Second Sub Job')
        ])->dispatch('Run Main Jobs');

        return redirect()->back()->with('success', 'Jobs run');
    }
}