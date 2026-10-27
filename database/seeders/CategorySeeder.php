<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Skincare & Facial',
                'slug' => 'skincare-facial',
                'type' => 'service',
                'icon' => 'sparkles',
                'description' => 'Perawatan wajah komprehensif untuk kulit cerah, bersih, dan glowing sehat.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Hair, Nail & Spa',
                'slug' => 'hair-nail-spa',
                'type' => 'service',
                'icon' => 'scissors',
                'description' => 'Perawatan rambut premium, Japanese head spa relaksasi, serta manicure dan nail art aesthetic.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Produk Skincare',
                'slug' => 'produk-skincare',
                'type' => 'product',
                'icon' => 'shopping-bag',
                'description' => 'Rangkaian produk skincare resmi teruji aman untuk perawatan harian di rumah.',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
