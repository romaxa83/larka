<?php

namespace App\Http\Controllers\Admin\Chart;

use App\Events\PrivateNodeMessageEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ChartController extends Controller
{
    public function line()
    {
        return [
            'labels' => ['март', 'апрель', 'май', 'июнь'],
            'datasets' => array([
                'label' => 'Sales',
                'backgroundColor' => '#F26202',
                'data' => [15000, 500, 3000, 4500, 100]
            ])
        ];
    }

    public function lineRandom(Request $response)
    {
//        if($response->input('realtime') !== null){
//
//            for($i = 0; $i < 10; $i++){
//                sleep(1);
//            event(new PrivateNodeMessageEvent($this->getData()));
//
//            }
//        }

        return $this->getData();
    }

    public function pie()
    {
        return [
            'labels' => ['март', 'апрель', 'май', 'июнь'],
            'datasets' => array([
                'label' => 'Sales',
                'backgroundColor' => ['#F26202', '#D01919', '#EAAE00', '#B5CC18'],
                'data' => [15000, 500, 3000, 4500, 100]
            ])
        ];
    }

    private function getData()
    {
        return [
            'labels' => ['март', 'апрель', 'май', 'июнь', 'июль'],
            'datasets' => array(
                [
                    'label' => 'Gold',
                    'backgroundColor' => '#F26202',
                    'data' => [rand(0, 4000), rand(0, 4000), rand(0, 4000), rand(0, 4000), rand(0, 4000)]
                ],
                [
                    'label' => 'Oil',
                    'backgroundColor' => '#16AB39',
                    'data' => [rand(0, 4000), rand(0, 4000), rand(0, 4000), rand(0, 4000), rand(0, 4000)]
                ],
                [
                    'label' => 'Silver',
                    'backgroundColor' => '#B5CC18',
                    'data' => [rand(0, 4000), rand(0, 4000), rand(0, 4000), rand(0, 4000), rand(0, 4000)]
                ],
            )
        ];
    }
}