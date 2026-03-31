<?php

namespace Database\Seeders;

use App\Models\ProductCategory;

use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
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
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Clothing',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Home & Kitchen',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Books',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Beauty & Personal Care',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Sports & Outdoors',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Health & Wellness',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Toys & Games',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Automotive',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Furniture',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Jewelry',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Baby & Kids',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Pet Supplies',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Office Supplies',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Tools & Home Improvement',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Groceries',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Music & Instruments',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Movies & TV Shows',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Arts & Crafts',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Party Supplies',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Industrial & Scientific',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Luggage & Travel',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Watches',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Shoes',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Handbags & Wallets',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Food & Beverages',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Fitness Equipment',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Garden & Outdoor',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Electronics Accessories',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Cameras & Photography',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Computer Accessories',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Video Games',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Cell Phones & Accessories',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Home Decor',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Bedding & Bath',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Kitchen Appliances',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Cookware & Dining',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Audio & Video',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Headphones',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Printers & Ink',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Musical Instruments',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Baby Clothing & Accessories',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Kids\' Clothing & Accessories',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Men\'s Clothing & Accessories',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ],
            [
                'name' => 'Women\'s Clothing & Accessories',
                'image' => 'https://res.cloudinary.com/dufkdra3z/image/upload/v1676934018/samples/ecommerce/leather-bag-gray.jpg',
            ]
        ];

        foreach ($categories as $item) {
            ProductCategory::create([
                'name' => $item['name'],
                'image' => $item['image']
            ]);
        }
    }
}
