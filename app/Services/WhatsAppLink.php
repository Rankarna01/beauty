<?php

namespace App\Services;

use App\Models\CatalogItem;

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
     * Dapatkan teks pesan hasil interpolasi template.
     */
    public static function getMessage(string $type, array $placeholders = []): string
    {
        $template = setting("whatsapp_templates.{$type}", self::getDefaultTemplate($type));

        return trim(self::interpolate($template, $placeholders));
    }

    /**
     * Buat URL https://wa.me/... dengan interpolasi template dinamis.
     */
    public static function build(string $type, array $placeholders = [], ?string $customPhone = null): string
    {
        $phone = self::cleanPhoneNumber($customPhone);
        $message = self::getMessage($type, $placeholders);

        return 'https://wa.me/' . $phone . '?text=' . rawurlencode($message);
    }

    /**
     * Buat URL WhatsApp khusus item katalog (otomatis bedakan jasa vs produk).
     */
    public static function buildForItem(CatalogItem $item, array $extras = []): string
    {
        $url = route('catalog.show', [
            'category' => $item->category->slug,
            'item' => $item->slug,
        ]);

        $type = $item->type === 'product' ? 'product_order' : 'service_inquiry';

        $defaults = [
            'nama_produk' => $item->name,
            'harga' => $item->formatted_price,
            'durasi' => $item->duration_minutes ?? '-',
            'url_item' => $url,
            'jumlah' => $extras['jumlah'] ?? '1 pcs',
            'nama' => $extras['nama'] ?? '-',
            'alamat' => $extras['alamat'] ?? '-',
        ];

        return self::build($type, array_merge($defaults, $extras));
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
            'booking' => "Halo Putri Beauty Care 👋\nSaya ingin booking jadwal perawatan:\n\nNama     : {nama}\nLayanan  : {layanan}\nTanggal  : {tanggal}\nJam      : {jam}\nCatatan  : {catatan}\n\nMohon info ketersediaan slot jadwalnya ya kak, terima kasih 🙏",

            'service_inquiry' => "Halo Putri Beauty Care 👋\nSaya tertarik dengan treatment:\n*{nama_produk}*\nTarif: {harga}\nDurasi: {durasi} menit\n\nApakah ada slot jadwal kosong untuk perawatan ini?\n{url_item}\n\nTerima kasih 🙏",

            'product_order' => "Halo Putri Beauty Care 👋\nSaya ingin pesan produk skincare:\n\nProduk   : {nama_produk}\nHarga    : {harga}\nJumlah   : {jumlah}\nNama     : {nama}\nAlamat   : {alamat}\n\nMohon info ketersediaan stok dan estimasi ongkir ke alamat saya ya kak, terima kasih 🙏\n{url_item}",

            'catalog_item' => "Halo Putri Beauty Care 👋\nSaya tertarik dengan *{nama_produk}* ({harga}).\nApakah slot / stok masih tersedia?\n{url_item}\n\nTerima kasih 🙏",

            'consultation' => "Halo kak, saya ingin konsultasi perawatan kulit & kecantikan di Putri Beauty Care Banda Aceh 👋",

            'promo_claim' => "Halo Putri Beauty Care 👋\nSaya ingin klaim promo spesial: *{promo_title}*.\n\nMohon info syarat dan jadwal yang masih tersedia, terima kasih 🙏",

            default => "Halo Putri Beauty Care 👋",
        };
    }
}
