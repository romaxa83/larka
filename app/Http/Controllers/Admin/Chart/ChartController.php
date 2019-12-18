<?php

namespace App\Http\Controllers\Admin\Chart;

use App\Http\Controllers\Controller;

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

    public function lineRandom()
    {
        return [
            'labels' => ['март', 'апрель', 'май', 'июнь'],
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
}