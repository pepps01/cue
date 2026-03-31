<?php

namespace Database\Seeders;

use App\Models\TripLocationPricingEssential;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripLocationPricingEssentialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pricings = [
            [
                "state" => "Abia",
                "areas" => "Umuahia",
                "base_fare" => NULL,
                "minimum_fare" => NULL,
                "distance_rate_per_km" => NULL,
                "time_rate_per_min" => NULL,
                "total_price" => NULL
            ],
            [
                "state" => "Adamawa",
                "areas" => "Yola",
                "base_fare" => NULL,
                "minimum_fare" => NULL,
                "distance_rate_per_km" => NULL,
                "time_rate_per_min" => NULL,
                "total_price" => NULL
            ],
            [
                "state" => "Akwa Ibom",
                "areas" => "Uyo",
                "base_fare" => 250,
                "minimum_fare" => 500,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 855
            ],
            [
                "state" => "Anambra",
                "areas" => "Awka",
                "base_fare" => 250,
                "minimum_fare" => 500,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 855
            ],
            [
                "state" => "Bauchi",
                "areas" => "Bauchi",
                "base_fare" => NULL,
                "minimum_fare" => NULL,
                "distance_rate_per_km" => NULL,
                "time_rate_per_min" => NULL,
                "total_price" => NULL
            ],
            [
                "state" => "Bayelsa",
                "areas" => "Yenagoa",
                "base_fare" => NULL,
                "minimum_fare" => NULL,
                "distance_rate_per_km" => NULL,
                "time_rate_per_min" => NULL,
                "total_price" => NULL
            ],
            [
                "state" => "Benue",
                "areas" => "Makurdi",
                "base_fare" => NULL,
                "minimum_fare" => NULL,
                "distance_rate_per_km" => NULL,
                "time_rate_per_min" => NULL,
                "total_price" => NULL
            ],
            [
                "state" => "Borno",
                "areas" => "Maiduguri",
                "base_fare" => NULL,
                "minimum_fare" => NULL,
                "distance_rate_per_km" => NULL,
                "time_rate_per_min" => NULL,
                "total_price" => NULL
            ],
            [
                "state" => "Cross River",
                "areas" => "Calabar",
                "base_fare" => NULL,
                "minimum_fare" => NULL,
                "distance_rate_per_km" => NULL,
                "time_rate_per_min" => NULL,
                "total_price" => NULL
            ],
            [
                "state" => "Delta",
                "areas" => "Asaba",
                "base_fare" => 250,
                "minimum_fare" => 500,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 855
            ],
            [
                "state" => "Ebonyi",
                "areas" => "Abakaliki",
                "base_fare" => NULL,
                "minimum_fare" => NULL,
                "distance_rate_per_km" => NULL,
                "time_rate_per_min" => NULL,
                "total_price" => NULL
            ],
            [
                "state" => "Edo",
                "areas" => "Benin City",
                "base_fare" => 300,
                "minimum_fare" => 500,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 905
            ],
            [
                "state" => "Ekiti",
                "areas" => "Ado Ekiti",
                "base_fare" => NULL,
                "minimum_fare" => NULL,
                "distance_rate_per_km" => NULL,
                "time_rate_per_min" => NULL,
                "total_price" => NULL
            ],
            [
                "state" => "Enugu",
                "areas" => "Enugu",
                "base_fare" => 350,
                "minimum_fare" => 500,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 955
            ],
            [
                "state" => "Gombe",
                "areas" => "Gombe",
                "base_fare" => NULL,
                "minimum_fare" => NULL,
                "distance_rate_per_km" => NULL,
                "time_rate_per_min" => NULL,
                "total_price" => NULL
            ],
            [
                "state" => "Imo",
                "areas" => "Owerri",
                "base_fare" => 250,
                "minimum_fare" => 500,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 855
            ],
            [
                "state" => "Jigawa",
                "areas" => "Dutse",
                "base_fare" => NULL,
                "minimum_fare" => NULL,
                "distance_rate_per_km" => NULL,
                "time_rate_per_min" => NULL,
                "total_price" => NULL
            ],
            [
                "state" => "Kaduna",
                "areas" => "Kaduna",
                "base_fare" => 350,
                "minimum_fare" => 600,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 1055
            ],
            [
                "state" => "Kano",
                "areas" => "Kano",
                "base_fare" => 350,
                "minimum_fare" => 600,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 1055
            ],
            [
                "state" => "Katsina",
                "areas" => "Katsina",
                "base_fare" => NULL,
                "minimum_fare" => NULL,
                "distance_rate_per_km" => NULL,
                "time_rate_per_min" => NULL,
                "total_price" => NULL
            ],
            [
                "state" => "Kebbi",
                "areas" => "Birnin Kebbi",
                "base_fare" => NULL,
                "minimum_fare" => NULL,
                "distance_rate_per_km" => NULL,
                "time_rate_per_min" => NULL,
                "total_price" => NULL
            ],
            [
                "state" => "Kogi",
                "areas" => "Lokoja",
                "base_fare" => 350,
                "minimum_fare" => 500,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 955
            ],
            [
                "state" => "Kwara",
                "areas" => "Ilorin",
                "base_fare" => NULL,
                "minimum_fare" => NULL,
                "distance_rate_per_km" => NULL,
                "time_rate_per_min" => NULL,
                "total_price" => NULL
            ],
            [
                "state" => "Lagos",
                "areas" => "Ikeja",
                "base_fare" => 350,
                "minimum_fare" => 500,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 955
            ],
            [
                "state" => "Nasarawa",
                "areas" => "Lafia",
                "base_fare" => 350,
                "minimum_fare" => 500,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 955
            ],
            [
                "state" => "Nasarawa",
                "areas" => "Maraba",
                "base_fare" => 350,
                "minimum_fare" => 500,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 955
            ],
            [
                "state" => "Niger",
                "areas" => "Minna",
                "base_fare" => 350,
                "minimum_fare" => 500,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 955
            ],
            [
                "state" => "Niger",
                "areas" => "Suleja",
                "base_fare" => 350,
                "minimum_fare" => 500,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 955
            ],
            [
                "state" => "Ogun",
                "areas" => "Abeokuta",
                "base_fare" => 350,
                "minimum_fare" => 600,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 1055
            ],
            [
                "state" => "Ondo",
                "areas" => "Akure",
                "base_fare" => 250,
                "minimum_fare" => 500,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 855
            ],
            [
                "state" => "Osun",
                "areas" => "Oshogbo",
                "base_fare" => NULL,
                "minimum_fare" => NULL,
                "distance_rate_per_km" => NULL,
                "time_rate_per_min" => NULL,
                "total_price" => NULL
            ],
            [
                "state" => "Oyo",
                "areas" => "Ibadan",
                "base_fare" => 350,
                "minimum_fare" => 500,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 955
            ],
            [
                "state" => "Plateau",
                "areas" => "Jos",
                "base_fare" => 250,
                "minimum_fare" => 500,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 855
            ],
            [
                "state" => "Rivers",
                "areas" => "Port Harcourt",
                "base_fare" => 300,
                "minimum_fare" => 500,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 905
            ],
            [
                "state" => "Sokoto",
                "areas" => "Sokoto",
                "base_fare" => NULL,
                "minimum_fare" => NULL,
                "distance_rate_per_km" => NULL,
                "time_rate_per_min" => NULL,
                "total_price" => NULL
            ],
            [
                "state" => "Taraba",
                "areas" => "Jalingo",
                "base_fare" => NULL,
                "minimum_fare" => NULL,
                "distance_rate_per_km" => NULL,
                "time_rate_per_min" => NULL,
                "total_price" => NULL
            ],
            [
                "state" => "Yobe",
                "areas" => "Damaturu",
                "base_fare" => NULL,
                "minimum_fare" => NULL,
                "distance_rate_per_km" => NULL,
                "time_rate_per_min" => NULL,
                "total_price" => NULL
            ],
            [
                "state" => "Zamfara",
                "areas" => "Gusau",
                "base_fare" => NULL,
                "minimum_fare" => NULL,
                "distance_rate_per_km" => NULL,
                "time_rate_per_min" => NULL,
                "total_price" => NULL
            ],
            [
                "state" => "FCT Abuja",
                "areas" => "Abuja",
                "base_fare" => 400,
                "minimum_fare" => 600,
                "distance_rate_per_km" => 90,
                "time_rate_per_min" => 15,
                "total_price" => 1105
            ],
        ];
        foreach ($pricings as $item) {
            TripLocationPricingEssential::create($item);
        }
    }
}
