<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        // $this->call(BankSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ServiceCategorySeeder::class);
        $this->call(MerchantCategorySeeder::class);
        $this->call(TripPricingSeeder::class);
        $this->call(TripLocationPricingEssentialSeeder::class);
        $this->call(TripLocationPricingLuxurySeeder::class);
        $this->call(TripLocationPricingEconomySeeder::class);
        $this->call(GeneralSettingSeeder::class);
        $this->call(CarListingSeeder::class);
        $this->call(RestaurantTypeSeeder::class);
    }
}
