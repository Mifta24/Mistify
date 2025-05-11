<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $perfumes = [
            [
                'name' => 'Black Opium',
                'description' => 'A highly addictive feminine fragrance from Yves Saint Laurent.',
                'price' => 1500000,
                'stock' => 50,
                'category_id' => 1
            ],
            [
                'name' => 'Bleu de Chanel',
                'description' => 'A woody aromatic fragrance for the modern man.',
                'price' => 1800000,
                'stock' => 40,
                'category_id' => 1
            ],
            [
                'name' => 'La Vie Est Belle',
                'description' => 'A sweet life-inspired fragrance from Lancôme.',
                'price' => 1600000,
                'stock' => 45,
                'category_id' => 1
            ],
            [
                'name' => 'Acqua di Gio',
                'description' => 'A fresh aquatic fragrance from Giorgio Armani.',
                'price' => 1400000,
                'stock' => 55,
                'category_id' => 1
            ],
            [
                'name' => 'Miss Dior',
                'description' => 'A classic floral fragrance from Christian Dior.',
                'price' => 1700000,
                'stock' => 35,
                'category_id' => 1
            ],
            [
                'name' => 'Light Blue',
                'description' => 'A refreshing Mediterranean-inspired scent from Dolce & Gabbana.',
                'price' => 1300000,
                'stock' => 60,
                'category_id' => 1
            ],
            [
                'name' => '1 Million',
                'description' => 'A bold and luxurious fragrance from Paco Rabanne.',
                'price' => 1450000,
                'stock' => 48,
                'category_id' => 1
            ],
            [
                'name' => 'J\'adore',
                'description' => 'An elegant floral bouquet from Christian Dior.',
                'price' => 1650000,
                'stock' => 42,
                'category_id' => 1
            ],
            [
                'name' => 'Aventus',
                'description' => 'A sophisticated blend from Creed.',
                'price' => 5500000,
                'stock' => 20,
                'category_id' => 1
            ],
            [
                'name' => 'Good Girl',
                'description' => 'A seductive fragrance from Carolina Herrera.',
                'price' => 1550000,
                'stock' => 45,
                'category_id' => 1
            ]
        ];

        foreach ($perfumes as $perfume) {
            Product::create([
                'name' => $perfume['name'],
                'slug' => Str::slug($perfume['name']),
                'description' => $perfume['description'],
                'price' => $perfume['price'],
                'stock' => $perfume['stock'],
                'category_id' => $perfume['category_id'],
                'image' => null // Make sure to have a default image
            ]);
        }
    }
}
