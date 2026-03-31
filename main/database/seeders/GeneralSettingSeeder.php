<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'flip_proposal_percentage',
                'value' => 0.10 //10%
            ],
            [
                'title' => 'trip_comm_percentage',
                'value' => 0.15 //15%
            ],
            [
                'title' => 'amount_per_point',
                'value' => 500 //in naira
            ],
            [
                'title' => 'ref_bonus',
                'value' => 200 //in naira
            ],
            [
                'title' => 'driver_performance_rides_no',
                'value' => 10
            ],
            [
                'title' => 'driver_performance_rides_reward',
                'value' => 1000 //in naira
            ],
            [
                'title' => 'trip_price_variation',
                'value' => 1.5 //150%
            ],
        ];

        foreach ($data as $item) {
            GeneralSetting::create($item);
        }
    }
}
