<?php

namespace Database\Seeders;

use App\Models\MerchantCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerchantCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Electronics',
            ],
            [
                'name' => 'Clothing',
            ],
            [
                'name' => 'Home & Kitchen',
            ],
            [
                'name' => 'Books',
            ],
            [
                'name' => 'Beauty & Personal Care',
            ],
            [
                'name' => 'Sports & Outdoors',
            ],
            [
                'name' => 'Health & Wellness',
            ],
            [
                'name' => 'Toys & Games',
            ],
            [
                'name' => 'Automotive',
            ],
            [
                'name' => 'Furniture',
            ],
            [
                'name' => 'Jewelry',
            ],
            [
                'name' => 'Baby & Kids',
            ],
            [
                'name' => 'Pet Supplies',
            ],
            [
                'name' => 'Office Supplies',
            ],
            [
                'name' => 'Tools & Home Improvement',
            ],
            [
                'name' => 'Groceries',
            ],
            [
                'name' => 'Music & Instruments',
            ],
            [
                'name' => 'Movies & TV Shows',
            ],
            [
                'name' => 'Arts & Crafts',
            ],
            [
                'name' => 'Party Supplies',
            ],
            [
                'name' => 'Industrial & Scientific',
            ],
            [
                'name' => 'Luggage & Travel',
            ],
            [
                'name' => 'Watches',
            ],
            [
                'name' => 'Shoes',
            ],
            [
                'name' => 'Handbags & Wallets',
            ],
            [
                'name' => 'Food & Beverages',
            ],
            [
                'name' => 'Fitness Equipment',
            ],
            [
                'name' => 'Garden & Outdoor',
            ],
            [
                'name' => 'Electronics Accessories',
            ],
            [
                'name' => 'Cameras & Photography',
            ],
            [
                'name' => 'Computer Accessories',
            ],
            [
                'name' => 'Video Games',
            ],
            [
                'name' => 'Cell Phones & Accessories',
            ],
            [
                'name' => 'Home Decor',
            ],
            [
                'name' => 'Bedding & Bath',
            ],
            [
                'name' => 'Kitchen Appliances',
            ],
            [
                'name' => 'Cookware & Dining',
            ],
            [
                'name' => 'Audio & Video',
            ],
            [
                'name' => 'Headphones',
            ],
            [
                'name' => 'Printers & Ink',
            ],
            [
                'name' => 'Musical Instruments',
            ],
            [
                'name' => 'Baby Clothing & Accessories',
            ],
            [
                'name' => 'Kids\' Clothing & Accessories',
            ],
            [
                'name' => 'Men\'s Clothing & Accessories',
            ],
            [
                'name' => 'Women\'s Clothing & Accessories',
            ]
        ];
        foreach ($categories as $item) {
            MerchantCategory::create([
                'name' => $item['name'],
            ]);
        }
    }
}
