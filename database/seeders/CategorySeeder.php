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
                'icon' => 'fa-solid fa-spa',
                'description' => 'Perawatan wajah komprehensif untuk kulit cerah, bersih, dan glowing sehat.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Nail Art',
                'slug' => 'nail-art',
                'type' => 'service',
                'icon' => 'fa-solid fa-hand-sparkles',
                'description' => 'Layanan Nail Gel, French Nail, Glitter, Ombre, Cat Eye, dan Nail Art Aesthetic.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Hair & Japanese Head Spa',
                'slug' => 'hair-nail-spa',
                'type' => 'service',
                'icon' => 'fa-solid fa-shower',
                'description' => 'Perawatan rambut premium, Japanese head spa relaksasi, dan creambath aromaterapi.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Produk Skincare',
                'slug' => 'produk-skincare',
                'type' => 'product',
                'icon' => 'fa-solid fa-pump-soap',
                'description' => 'Rangkaian produk skincare resmi teruji aman untuk perawatan harian di rumah.',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
