<?php

namespace App\Services;

class WhatsAppLink
{
    /**
     * Normalisasi nomor HP ke format internasional WhatsApp (hanya digit, diawali 62).
     */
    public static function cleanPhoneNumber(?string $number): string
    {
        if (empty($number)) {
            $number = setting('contact.whatsapp_main', '6281362673728');
        }

        // Ambil hanya digit
        $cleaned = preg_replace('/[^0-9]/', '', (string) $number);

        // Jika diawali 08..., ganti 0 dengan 62
        if (str_starts_with($cleaned, '0')) {
            $cleaned = '62' . substr($cleaned, 1);
        } elseif (str_starts_with($cleaned, '8')) {
            $cleaned = '62' . $cleaned;
        }

        return $cleaned;
    }

    /**
     * Buat URL https://wa.me/... dengan interpolasi template dinamis.
     */
    public static function build(string $type, array $placeholders = [], ?string $customPhone = null): string
    {
        $phone = self::cleanPhoneNumber($customPhone);
        $template = setting("whatsapp_templates.{$type}", self::getDefaultTemplate($type));

        $message = self::interpolate($template, $placeholders);

        return 'https://wa.me/' . $phone . '?text=' . rawurlencode(trim($message));
    }

    /**
     * Ganti placeholder dalam teks template.
     */
    public static function interpolate(string $template, array $placeholders): string
    {
        $search = [];
        $replace = [];

        foreach ($placeholders as $key => $val) {
            $normalizedKey = '{' . trim($key, '{}') . '}';
            $search[] = $normalizedKey;
            $replace[] = (string) $val;
        }

        return str_replace($search, $replace, $template);
    }

    /**
     * Template fallback jika belum terset di pengaturan.
     */
    public static function getDefaultTemplate(string $type): string
    {
        return match ($type) {
            'booking' => "Halo Putri Beauty Care 👋\nSaya ingin booking:\n\nNama     : {nama}\nLayanan  : {layanan}\nTanggal  : {tanggal}\nJam      : {jam}\nCatatan  : {catatan}\n\nMohon info ketersediaan jadwalnya, terima kasih 🙏",
            'catalog_item' => "Halo Putri Beauty Care 👋\nSaya tertarik dengan {nama_produk} ({harga}).\nApakah slot / stok masih tersedia?\n{url_item}",
            'consultation' => "Halo kak, saya ingin konsultasi tentang perawatan kecantikan di Putri Beauty Care 👋",
            'promo_claim' => "Halo Putri Beauty Care 👋\nSaya ingin klaim promo: *{promo_title}*.\nMohon info syarat dan jadwal yang tersedia, terima kasih 🙏",
            default => "Halo Putri Beauty Care 👋",
        };
    }
}
