<?php

namespace Database\Seeders;

use App\Models\TripPricing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripPricingSeeder extends Seeder
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
                'base_fare' => "400",
            ],
            [
                'minimum_fare' => "600",
            ],
            [
                'distance_rate_per_km' => "90",
            ],
            [
                'time_rate_per_min' => "15",
            ],
        ];
        foreach ($data as $item) {
            TripPricing::updateOrCreate($item);
        }
    }
}
