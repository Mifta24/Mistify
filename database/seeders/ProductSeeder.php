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
                'category_id' => 1,
                'brand' => 'Yves Saint Laurent',
                'default_size' => '50',
                'fragrance_family' => 'Oriental Vanilla',
                'gender' => 'Women',
                'concentration' => 'Eau de Parfum',
                'sizes' => [
                    [
                        'size' => '30',
                        'price' => '1200000.00',
                        'stock' => '15'
                    ],
                    [
                        'size' => '50',
                        'price' => '1500000.00',
                        'stock' => '20'
                    ],
                    [
                        'size' => '90',
                        'price' => '1900000.00',
                        'stock' => '15'
                    ]
                ]
            ],
            [
                'name' => 'Bleu de Chanel',
                'description' => 'A woody aromatic fragrance for the modern man.',
                'price' => 1800000,
                'stock' => 40,
                'category_id' => 1,
                'brand' => 'Chanel',
                'default_size' => '50',
                'fragrance_family' => 'Woody Aromatic',
                'gender' => 'Men',
                'concentration' => 'Eau de Parfum',
                'sizes' => [
                    [
                        'size' => '50',
                        'price' => '1800000.00',
                        'stock' => '25'
                    ],
                    [
                        'size' => '100',
                        'price' => '2300000.00',
                        'stock' => '15'
                    ]
                ]
            ],
            [
                'name' => 'La Vie Est Belle',
                'description' => 'A sweet life-inspired fragrance from Lancôme.',
                'price' => 1600000,
                'stock' => 45,
                'category_id' => 1,
                'brand' => 'Lancôme',
                'default_size' => '50',
                'fragrance_family' => 'Floral Fruity Gourmand',
                'gender' => 'Women',
                'concentration' => 'Eau de Parfum',
                'sizes' => [
                    [
                        'size' => '30',
                        'price' => '1300000.00',
                        'stock' => '20'
                    ],
                    [
                        'size' => '50',
                        'price' => '1600000.00',
                        'stock' => '15'
                    ],
                    [
                        'size' => '100',
                        'price' => '2100000.00',
                        'stock' => '10'
                    ]
                ]
            ],
            [
                'name' => 'Acqua di Gio',
                'description' => 'A fresh aquatic fragrance from Giorgio Armani.',
                'price' => 1400000,
                'stock' => 55,
                'category_id' => 1,
                'brand' => 'Giorgio Armani',
                'default_size' => '50',
                'fragrance_family' => 'Aquatic Aromatic',
                'gender' => 'Men',
                'concentration' => 'Eau de Toilette',
                'sizes' => [
                    [
                        'size' => '50',
                        'price' => '1400000.00',
                        'stock' => '30'
                    ],
                    [
                        'size' => '100',
                        'price' => '1800000.00',
                        'stock' => '25'
                    ]
                ]
            ],
            [
                'name' => 'Miss Dior',
                'description' => 'A classic floral fragrance from Christian Dior.',
                'price' => 1700000,
                'stock' => 35,
                'category_id' => 1,
                'brand' => 'Christian Dior',
                'default_size' => '50',
                'fragrance_family' => 'Chypre Floral',
                'gender' => 'Women',
                'concentration' => 'Eau de Parfum',
                'sizes' => [
                    [
                        'size' => '30',
                        'price' => '1400000.00',
                        'stock' => '15'
                    ],
                    [
                        'size' => '50',
                        'price' => '1700000.00',
                        'stock' => '10'
                    ],
                    [
                        'size' => '100',
                        'price' => '2300000.00',
                        'stock' => '10'
                    ]
                ]
            ],
            [
                'name' => 'Light Blue',
                'description' => 'A refreshing Mediterranean-inspired scent from Dolce & Gabbana.',
                'price' => 1300000,
                'stock' => 60,
                'category_id' => 1,
                'brand' => 'Dolce & Gabbana',
                'default_size' => '50',
                'fragrance_family' => 'Citrus Aromatic',
                'gender' => 'Women',
                'concentration' => 'Eau de Toilette',
                'sizes' => [
                    [
                        'size' => '25',
                        'price' => '950000.00',
                        'stock' => '20'
                    ],
                    [
                        'size' => '50',
                        'price' => '1300000.00',
                        'stock' => '25'
                    ],
                    [
                        'size' => '100',
                        'price' => '1750000.00',
                        'stock' => '15'
                    ]
                ]
            ],
            [
                'name' => '1 Million',
                'description' => 'A bold and luxurious fragrance from Paco Rabanne.',
                'price' => 1450000,
                'stock' => 48,
                'category_id' => 1,
                'brand' => 'Paco Rabanne',
                'default_size' => '50',
                'fragrance_family' => 'Woody Spicy',
                'gender' => 'Men',
                'concentration' => 'Eau de Toilette',
                'sizes' => [
                    [
                        'size' => '50',
                        'price' => '1450000.00',
                        'stock' => '28'
                    ],
                    [
                        'size' => '100',
                        'price' => '1950000.00',
                        'stock' => '20'
                    ]
                ]
            ],
            [
                'name' => 'J\'adore',
                'description' => 'An elegant floral bouquet from Christian Dior.',
                'price' => 1650000,
                'stock' => 42,
                'category_id' => 1,
                'brand' => 'Christian Dior',
                'default_size' => '50',
                'fragrance_family' => 'Floral Fruity',
                'gender' => 'Women',
                'concentration' => 'Eau de Parfum',
                'sizes' => [
                    [
                        'size' => '30',
                        'price' => '1350000.00',
                        'stock' => '15'
                    ],
                    [
                        'size' => '50',
                        'price' => '1650000.00',
                        'stock' => '15'
                    ],
                    [
                        'size' => '100',
                        'price' => '2250000.00',
                        'stock' => '12'
                    ]
                ]
            ],
            [
                'name' => 'Aventus',
                'description' => 'A sophisticated blend from Creed.',
                'price' => 5500000,
                'stock' => 20,
                'category_id' => 1,
                'brand' => 'Creed',
                'default_size' => '50',
                'fragrance_family' => 'Fruity Chypre',
                'gender' => 'Men',
                'concentration' => 'Eau de Parfum',
                'sizes' => [
                    [
                        'size' => '50',
                        'price' => '5500000.00',
                        'stock' => '10'
                    ],
                    [
                        'size' => '100',
                        'price' => '7500000.00',
                        'stock' => '10'
                    ]
                ]
            ],
            [
                'name' => 'Good Girl',
                'description' => 'A seductive fragrance from Carolina Herrera.',
                'price' => 1550000,
                'stock' => 45,
                'category_id' => 1,
                'brand' => 'Carolina Herrera',
                'default_size' => '50',
                'fragrance_family' => 'Oriental Floral',
                'gender' => 'Women',
                'concentration' => 'Eau de Parfum',
                'sizes' => [
                    [
                        'size' => '30',
                        'price' => '1250000.00',
                        'stock' => '15'
                    ],
                    [
                        'size' => '50',
                        'price' => '1550000.00',
                        'stock' => '20'
                    ],
                    [
                        'size' => '80',
                        'price' => '1950000.00',
                        'stock' => '10'
                    ]
                ]
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
                'brand' => $perfume['brand'] ?? null,
                'default_size' => $perfume['default_size'] ?? null,
                'fragrance_family' => $perfume['fragrance_family'] ?? null,
                'gender' => $perfume['gender'] ?? null,
                'concentration' => $perfume['concentration'] ?? null,
                'sizes' => $perfume['sizes'] ?? null,
                'image' => null // Make sure to have a default image
            ]);
        }
    }
}
