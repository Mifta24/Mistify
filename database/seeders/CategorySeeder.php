<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Eau de Parfum',
                'description' => 'Premium fragrances with 15-20% perfume oil concentration, lasting 6-8 hours. Perfect for special occasions.',
                'image' => 'categories/edp.jpg',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Eau de Toilette',
                'description' => 'Classic fragrances with 5-15% perfume oil concentration, ideal for daily wear.',
                'image' => 'categories/edt.jpg',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Niche Perfumes',
                'description' => 'Exclusive and unique luxury fragrances from boutique perfume houses.',
                'image' => 'categories/niche.jpg',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'Celebrity Fragrances',
                'description' => 'Popular fragrances created in collaboration with celebrities.',
                'image' => 'categories/celebrity.jpg',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'Travel Size',
                'description' => 'Compact versions of your favorite fragrances, perfect for travel.',
                'image' => 'categories/travel.jpg',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'name' => 'Gift Sets',
                'description' => 'Curated collections featuring perfumes and complementary products.',
                'image' => 'categories/giftset.jpg',
                'is_active' => true,
                'sort_order' => 6
            ],
            [
                'name' => 'Limited Editions',
                'description' => 'Special release fragrances available for a limited time.',
                'image' => 'categories/limited.jpg',
                'is_active' => false,
                'sort_order' => 7
            ]
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'image' => null,
                'is_active' => $category['is_active'],
                'sort_order' => $category['sort_order']
            ]);
        }
    }
}
