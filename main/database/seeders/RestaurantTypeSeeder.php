<?php

namespace Database\Seeders;

use App\Models\RestaurantType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'Bakery',
            ],
            [
                'name' => 'Breakfast',
            ],
            [
                'name' => 'Burgers',
            ],
            [
                'name' => 'Chicken',
            ],
            [
                'name' => 'Chinese',
            ],
            [
                'name' => 'Desserts',
            ],
            [
                'name' => 'Gril',
            ],
            [
                'name' => 'Healthy',
            ],
            [
                'name' => 'Ice Cream',
            ],
            [
                'name' => 'Indian',
            ],
            [
                'name' => 'International',
            ],
            [
                'name' => 'Jollof',
            ],
            [
                'name' => 'Juices',
            ],
            [
                'name' => 'Local food',
            ],
            [
                'name' => 'Nigerian',
            ],
            [
                'name' => 'Pasta',
            ],
            [
                'name' => 'Pizza',
            ],
            [
                'name' => 'Seafood',
            ],
            [
                'name' => 'Shawarma',
            ],
            [
                'name' => 'Snacks',
            ],
            [
                'name' => 'Sushi',
            ],
            [
                'name' => 'Traditional',
            ],
            [
                'name' => 'Vegetarian',
            ],
        ];
        foreach ($types as $type) {
            RestaurantType::create($type);
        }
    }
}
