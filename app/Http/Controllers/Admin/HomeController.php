<?php

namespace App\Http\Controllers\Admin;

use App\Events\ChartRealTimeEvent;
use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    /**
     * @var DashboardService
     */
    private $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $title = 'Dashboard';

        $horizonStatus = $this->dashboardService->checkHorizon();

//        $node = $this->dashboardService->checkNodeSocketServer();

        return view('admin.home', compact('title', 'horizonStatus'));
    }


    public function checkSocket()
    {
        $redis = Redis::connection('socket');
        $redis->set('cubic', 'rubic');
//        Redis::set('name', 'Taylor');

        event(new ChartRealTimeEvent(['message' =>'test_socket']));
        return redirect()->route('admin.home');
    }
}