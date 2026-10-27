<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Identitas
            ['key' => 'general.brand_name', 'value' => 'Putri Beauty Care', 'group' => 'general', 'type' => 'string'],
            ['key' => 'general.tagline', 'value' => 'Salon, Aesthetic & Skincare', 'group' => 'general', 'type' => 'string'],
            ['key' => 'general.slogan', 'value' => 'Your Beauty, Our Care', 'group' => 'general', 'type' => 'string'],
            ['key' => 'general.footer_text', 'value' => 'Salon, Skincare & Aesthetic Banda Aceh · Follow for more updates', 'group' => 'general', 'type' => 'string'],
            ['key' => 'general.logo', 'value' => null, 'group' => 'general', 'type' => 'string'],
            ['key' => 'general.cover_photo', 'value' => null, 'group' => 'general', 'type' => 'string'],

            // Kontak
            ['key' => 'contact.whatsapp_main', 'value' => '6281362673728', 'group' => 'contact', 'type' => 'string'],
            ['key' => 'contact.whatsapp_consultation', 'value' => '6281362673728', 'group' => 'contact', 'type' => 'string'],
            ['key' => 'contact.email', 'value' => 'putribeautycare.id@gmail.com', 'group' => 'contact', 'type' => 'string'],

            // Sosial Media
            ['key' => 'social.instagram_username', 'value' => 'putribeautycare', 'group' => 'social', 'type' => 'string'],
            ['key' => 'social.instagram_url', 'value' => 'https://instagram.com/putribeautycare', 'group' => 'social', 'type' => 'string'],
            ['key' => 'social.tiktok_url', 'value' => 'https://tiktok.com/@putribeautycare', 'group' => 'social', 'type' => 'string'],

            // Tampilan & Chip Beranda
            ['key' => 'appearance.show_floating_wa', 'value' => true, 'group' => 'appearance', 'type' => 'boolean'],
            ['key' => 'appearance.featured_service_chips', 'value' => [
                'Facial Treatment',
                'Hair Cut',
                'Creambath',
                'Hairmask',
                'Manicure',
                'Nail Art',
                'Head Japanese Spa',
            ], 'group' => 'appearance', 'type' => 'json'],

            // Template WhatsApp
            ['key' => 'whatsapp_templates.booking', 'value' => "Halo Putri Beauty Care 👋\nSaya ingin booking:\n\nNama     : {nama}\nLayanan  : {layanan}\nTanggal  : {tanggal}\nJam      : {jam}\nCatatan  : {catatan}\n\nMohon info ketersediaan jadwalnya, terima kasih 🙏", 'group' => 'whatsapp_templates', 'type' => 'text'],
            ['key' => 'whatsapp_templates.catalog_item', 'value' => "Halo Putri Beauty Care 👋\nSaya tertarik dengan {nama_produk} ({harga}).\nApakah slot / stok masih tersedia?\n{url_item}", 'group' => 'whatsapp_templates', 'type' => 'text'],
            ['key' => 'whatsapp_templates.consultation', 'value' => "Halo kak, saya ingin konsultasi tentang perawatan kecantikan di Putri Beauty Care 👋", 'group' => 'whatsapp_templates', 'type' => 'text'],
            ['key' => 'whatsapp_templates.promo_claim', 'value' => "Halo Putri Beauty Care 👋\nSaya ingin klaim promo: *{promo_title}*.\nMohon info syarat dan jadwal yang tersedia, terima kasih 🙏", 'group' => 'whatsapp_templates', 'type' => 'text'],

            // SEO & Analitik
            ['key' => 'seo.meta_title', 'value' => 'Putri Beauty Care – Salon, Aesthetic & Skincare Banda Aceh', 'group' => 'seo', 'type' => 'string'],
            ['key' => 'seo.meta_description', 'value' => 'Katalog resmi dan booking perawatan Putri Beauty Care: Skincare, Facial, Hair Treatment, Head Japanese Spa & Nail Art terbaik di Banda Aceh.', 'group' => 'seo', 'type' => 'string'],
            ['key' => 'analytics.enable_wa_logging', 'value' => true, 'group' => 'analytics', 'type' => 'boolean'],
        ];

        foreach ($settings as $setting) {
            Setting::setValue($setting['key'], $setting['value'], $setting['group'], $setting['type']);
        }
    }
}
