<?php

namespace Database\Seeders;

use App\Models\MenuLink;
use Illuminate\Database\Seeder;

class MenuLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            [
                'label' => 'Booking Salon & Skincare',
                'description' => 'Reservasi jadwal perawatan favoritmu dengan cepat',
                'icon' => 'calendar',
                'badge_text' => null,
                'type' => 'internal_route',
                'url' => '/booking',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'label' => 'Daftar Harga Treatment',
                'description' => 'Price list lengkap seluruh layanan salon & aesthetic',
                'icon' => 'clipboard-document-list',
                'badge_text' => null,
                'type' => 'internal_route',
                'url' => '/harga',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'label' => 'Promo Bulan Ini',
                'description' => 'Penawaran spesial & diskon perawatan terbatas',
                'icon' => 'sparkles',
                'badge_text' => 'Hot',
                'type' => 'internal_route',
                'url' => '/promo',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'label' => 'Skincare & Facial Treatment',
                'description' => 'Katalog lengkap treatment wajah & pencerah kulit',
                'icon' => 'sparkles',
                'badge_text' => null,
                'type' => 'internal_route',
                'url' => '/katalog/skincare-facial',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'label' => 'Hair, Nail & Japanese Head Spa',
                'description' => 'Relaksasi kepala, hair styling & nail art aesthetic',
                'icon' => 'heart',
                'badge_text' => null,
                'type' => 'internal_route',
                'url' => '/katalog/hair-nail-spa',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'label' => 'Konsultasi WhatsApp',
                'description' => 'Tanya terapis seputar keluhan kulit & rambutmu',
                'icon' => 'chat-bubble-left-right',
                'badge_text' => null,
                'type' => 'whatsapp',
                'url' => '/konsultasi',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'label' => 'Lokasi Salon & Jam Buka',
                'description' => 'Petunjuk arah Google Maps & cabang Banda Aceh',
                'icon' => 'map-pin',
                'badge_text' => null,
                'type' => 'internal_route',
                'url' => '/lokasi',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'label' => 'Instagram @putribeautycare',
                'description' => 'Lihat hasil treatment & portofolio terbaru kami',
                'icon' => 'camera',
                'badge_text' => null,
                'type' => 'external_url',
                'url' => '/instagram',
                'sort_order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($links as $link) {
            MenuLink::updateOrCreate(
                ['label' => $link['label']],
                $link
            );
        }
    }
}
