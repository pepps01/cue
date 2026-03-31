<?php

namespace Database\Seeders;


use App\ThirdParty;
use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = getBanks();
        $decode = json_decode($banks, true);
        foreach ($decode['data'] as $item) {
            Bank::create([
                'bank_name' => $item['name'],
                'abbreviation' => $item['slug'],
                'bank_code' => $item['code']
            ]);
        }
    }
}
