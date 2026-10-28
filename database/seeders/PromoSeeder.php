<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    /**
     * Seed promos based on official flyers:
     * - Flyer 3: Paket Bundling Hemat (6 Pilihan Paket)
     * - Flyer 2: Hair Treatment & Treatment Tambahan
     * - Flyer 2: Nail & Eye Treatment
     * - Flyer 4: Menu Treatment Messo, Bright & Glow, Hair Removal IPL
     */
    public function run(): void
    {
        // Purge old dummy promos so only the official text-only flyer promos exist
        \Illuminate\Support\Facades\DB::table('catalog_item_promo')->delete();
        Promo::query()->forceDelete();

        // 1. Promo Paket Bundling Hemat (Flyer Gambar 3)
        Promo::create(
            [
                'slug' => 'promo-bundling-hemat',
                'title' => 'Promo Bundling Hemat Spesial (6 Pilihan Paket)',
                'banner_path' => null,
                'summary' => 'Kombinasi paket bundling treatment salon & spa paling favorit dan super hemat, mulai dari Rp 68.000 saja!',
                'content' => '
<div class="grid grid-cols-2 gap-2.5 my-3">
    <div class="bg-[#FFF7F4] border border-[#F3E2DA] rounded-2xl p-3 flex flex-col items-center text-center shadow-xs">
        <span class="bg-[#80382B] text-white font-black text-sm px-3.5 py-0.5 rounded-full mb-1.5 shadow-xs">80k</span>
        <span class="font-bold text-xs text-[#3B1A2B] leading-tight">Creambath Premium + Catok</span>
    </div>
    <div class="bg-[#FFF7F4] border border-[#F3E2DA] rounded-2xl p-3 flex flex-col items-center text-center shadow-xs">
        <span class="bg-[#80382B] text-white font-black text-sm px-3.5 py-0.5 rounded-full mb-1.5 shadow-xs">135k</span>
        <span class="font-bold text-xs text-[#3B1A2B] leading-tight">Refleksi + Creambath</span>
    </div>
    <div class="bg-[#FFF7F4] border border-[#F3E2DA] rounded-2xl p-3 flex flex-col items-center text-center shadow-xs">
        <span class="bg-[#80382B] text-white font-black text-sm px-3.5 py-0.5 rounded-full mb-1.5 shadow-xs">68k</span>
        <span class="font-bold text-xs text-[#3B1A2B] leading-tight">Menicure + Henna Tangan</span>
    </div>
    <div class="bg-[#FFF7F4] border border-[#F3E2DA] rounded-2xl p-3 flex flex-col items-center text-center shadow-xs">
        <span class="bg-[#80382B] text-white font-black text-sm px-3.5 py-0.5 rounded-full mb-1.5 shadow-xs">160k</span>
        <span class="font-bold text-xs text-[#3B1A2B] leading-tight">Head Japanese Spa + Refleksi Kaki</span>
    </div>
    <div class="bg-[#FFF7F4] border border-[#F3E2DA] rounded-2xl p-3 flex flex-col items-center text-center shadow-xs">
        <span class="bg-[#80382B] text-white font-black text-sm px-3.5 py-0.5 rounded-full mb-1.5 shadow-xs">115k</span>
        <span class="font-bold text-xs text-[#3B1A2B] leading-tight">Creambath + Pedicure + Callus</span>
    </div>
    <div class="bg-[#FFF7F4] border border-[#F3E2DA] rounded-2xl p-3 flex flex-col items-center text-center shadow-xs">
        <span class="bg-[#80382B] text-white font-black text-sm px-3.5 py-0.5 rounded-full mb-1.5 shadow-xs">198k</span>
        <span class="font-bold text-xs text-[#3B1A2B] leading-tight">Head Japanese Spa + Facial Basic</span>
    </div>
</div>
<p class="text-xs text-[#8A6477] mt-2"><em>*Berlaku untuk reservasi via WhatsApp dan langsung di outlet Putri Beauty Care.</em></p>
',
                'starts_at' => now()->startOfMonth(),
                'ends_at' => now()->endOfMonth()->addDays(60),
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        // 2. Promo Hair Treatment & Treatment Tambahan (Flyer Gambar 2)
        Promo::create(
            [
                'slug' => 'promo-hair-treatment-tambahan',
                'title' => 'Promo Hair Treatment & Perawatan Tambahan',
                'banner_path' => null,
                'summary' => 'Daftar promo creambath buah, premium, hairmask, hairspa, Japanese spa serta treatment tambahan nano mist & haircut.',
                'content' => '
<div class="grid grid-cols-1 sm:grid-cols-2 gap-3 my-3">
    <!-- Hair Treatment -->
    <div class="bg-[#FFF7F4] border border-[#F3E2DA] rounded-2xl p-3.5 flex flex-col">
        <div class="bg-[#80382B] text-white text-xs font-bold px-3 py-1 rounded-full text-center mb-2.5 tracking-wide self-start shadow-xs">
            Hair Treatment
        </div>
        <div class="space-y-1.5 text-xs text-[#3B1A2B]">
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• Creambath Standar</span>
                <span class="font-black text-[#80382B]">50k</span>
            </div>
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• Creambath Buah</span>
                <span class="font-black text-[#80382B]">65k</span>
            </div>
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• Creambath Premium</span>
                <span class="font-black text-[#80382B]">95k</span>
            </div>
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• Hairmask</span>
                <span class="font-black text-[#80382B]">90k</span>
            </div>
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• Hairspa</span>
                <span class="font-black text-[#80382B]">100k</span>
            </div>
            <div class="flex items-center justify-between py-1">
                <span>• Head Japanese Spa</span>
                <span class="font-black text-[#80382B]">140k</span>
            </div>
        </div>
    </div>

    <!-- Treatment Tambahan -->
    <div class="bg-[#FFF7F4] border border-[#F3E2DA] rounded-2xl p-3.5 flex flex-col">
        <div class="bg-[#80382B] text-white text-xs font-bold px-3 py-1 rounded-full text-center mb-2.5 tracking-wide self-start shadow-xs">
            Treatment Tambahan
        </div>
        <div class="space-y-1.5 text-xs text-[#3B1A2B]">
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• High Frequency</span>
                <span class="font-black text-[#80382B]">25k</span>
            </div>
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• Nano Mist</span>
                <span class="font-black text-[#80382B]">60k</span>
            </div>
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• Catok / Curly</span>
                <span class="font-black text-[#80382B]">15k</span>
            </div>
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• Scalp Detox</span>
                <span class="font-black text-[#80382B]">25k</span>
            </div>
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• Vacum Kutu</span>
                <span class="font-black text-[#80382B]">25k</span>
            </div>
            <div class="flex items-center justify-between py-1">
                <span>• Haircut</span>
                <span class="font-black text-[#80382B]">25k</span>
            </div>
        </div>
    </div>
</div>
<p class="text-xs text-[#8A6477] mt-2"><em>*Harga promo berlaku selama periode berjalan. Reservasi terlebih dahulu untuk memastikan ketersediaan tempat.</em></p>
',
                'starts_at' => now()->startOfMonth(),
                'ends_at' => now()->endOfMonth()->addDays(60),
                'is_active' => true,
                'sort_order' => 2,
            ]
        );

        // 3. Promo Nail & Eye Treatment (Flyer Gambar 2)
        Promo::create(
            [
                'slug' => 'promo-nail-eye-treatment',
                'title' => 'Promo Nail & Eye Treatment',
                'banner_path' => null,
                'summary' => 'Daftar promo manicure, pedicure, treatment callus, footspa, hingga lash lift natural & tint.',
                'content' => '
<div class="grid grid-cols-1 sm:grid-cols-2 gap-3 my-3">
    <!-- Nail Treatment -->
    <div class="bg-[#FFF7F4] border border-[#F3E2DA] rounded-2xl p-3.5 flex flex-col">
        <div class="bg-[#80382B] text-white text-xs font-bold px-3 py-1 rounded-full text-center mb-2.5 tracking-wide self-start shadow-xs">
            Nail Treatment
        </div>
        <div class="space-y-1.5 text-xs text-[#3B1A2B]">
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• Menicure</span>
                <span class="font-black text-[#80382B]">50k</span>
            </div>
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• Pedicure</span>
                <span class="font-black text-[#80382B]">95k</span>
            </div>
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• Menipedi</span>
                <span class="font-black text-[#80382B]">115k</span>
            </div>
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• Treatment Callus</span>
                <span class="font-black text-[#80382B]">50k</span>
            </div>
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• Footspa</span>
                <span class="font-black text-[#80382B]">60k</span>
            </div>
            <div class="flex items-center justify-between py-1">
                <span>• Menipedi Premium</span>
                <span class="font-black text-[#80382B]">145k</span>
            </div>
        </div>
    </div>

    <!-- Eye Treatment -->
    <div class="bg-[#FFF7F4] border border-[#F3E2DA] rounded-2xl p-3.5 flex flex-col">
        <div class="bg-[#80382B] text-white text-xs font-bold px-3 py-1 rounded-full text-center mb-2.5 tracking-wide self-start shadow-xs">
            Eye Treatment
        </div>
        <div class="space-y-1.5 text-xs text-[#3B1A2B]">
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• Lash Lift</span>
                <span class="font-black text-[#80382B]">70k</span>
            </div>
            <div class="flex items-center justify-between py-1">
                <span>• Lash Lift + Tint</span>
                <span class="font-black text-[#80382B]">85k</span>
            </div>
        </div>
    </div>
</div>
<p class="text-xs text-[#8A6477] mt-2"><em>*Tampil cantik dengan kuku rapi berkilau dan bulu mata lentik alami setiap hari.</em></p>
',
                'starts_at' => now()->startOfMonth(),
                'ends_at' => now()->endOfMonth()->addDays(60),
                'is_active' => true,
                'sort_order' => 3,
            ]
        );

        // 4. Promo Messo Glow & Hair Removal IPL (Flyer Gambar 4)
        Promo::create(
            [
                'slug' => 'promo-messo-glow-hair-removal-ipl',
                'title' => 'Promo Messo Glow & Hair Removal IPL Treatment',
                'banner_path' => null,
                'summary' => 'Perawatan wajah Messo Non Needle (free alat), Peeling Korean Glow, Oxygeneo & IPL Hair Removal mulus tanpa bulu.',
                'content' => '
<div class="grid grid-cols-1 sm:grid-cols-3 gap-3 my-3">
    <!-- Messo Non Needle -->
    <div class="bg-[#FFF7F4] border border-[#F3E2DA] rounded-2xl p-3.5 flex flex-col">
        <div class="bg-[#80382B] text-white text-xs font-bold px-3 py-1 rounded-full text-center mb-2.5 tracking-wide self-start shadow-xs">
            Messo Non Needle
        </div>
        <div class="space-y-2 text-xs text-[#3B1A2B]">
            <div class="py-1 border-b border-pink-100/60">
                <div class="flex items-center justify-between">
                    <span class="font-medium">• Messo Acne Hydrating</span>
                    <span class="font-black text-[#80382B]">135k</span>
                </div>
                <span class="text-[10px] text-[#C2095F] font-semibold block mt-0.5">Free High Frequency</span>
            </div>
            <div class="py-1">
                <div class="flex items-center justify-between">
                    <span class="font-medium">• Messo Whitening Glow</span>
                    <span class="font-black text-[#80382B]">145k</span>
                </div>
                <span class="text-[10px] text-[#C2095F] font-semibold block mt-0.5">Free Skin Scrubber</span>
            </div>
        </div>
    </div>

    <!-- Bright and Glow -->
    <div class="bg-[#FFF7F4] border border-[#F3E2DA] rounded-2xl p-3.5 flex flex-col">
        <div class="bg-[#80382B] text-white text-xs font-bold px-3 py-1 rounded-full text-center mb-2.5 tracking-wide self-start shadow-xs">
            Bright & Glow
        </div>
        <div class="space-y-1.5 text-xs text-[#3B1A2B]">
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• Peeling Korean Glow</span>
                <span class="font-black text-[#80382B]">150k</span>
            </div>
            <div class="flex items-center justify-between py-1">
                <span>• Oxygeneo Super Facial</span>
                <span class="font-black text-[#80382B]">235k</span>
            </div>
        </div>
    </div>

    <!-- Hair Removal Treatment -->
    <div class="bg-[#FFF7F4] border border-[#F3E2DA] rounded-2xl p-3.5 flex flex-col">
        <div class="bg-[#80382B] text-white text-xs font-bold px-3 py-1 rounded-full text-center mb-2.5 tracking-wide self-start shadow-xs">
            Hair Removal IPL
        </div>
        <div class="space-y-1.5 text-xs text-[#3B1A2B]">
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• IPL Keti</span>
                <span class="font-black text-[#80382B]">115k</span>
            </div>
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• IPL Kaki</span>
                <span class="font-black text-[#80382B]">170k</span>
            </div>
            <div class="flex items-center justify-between py-1 border-b border-pink-100/60">
                <span>• IPL Keti + Peeling</span>
                <span class="font-black text-[#80382B]">190k</span>
            </div>
            <div class="flex items-center justify-between py-1">
                <span>• IPL Keti + Laser</span>
                <span class="font-black text-[#80382B]">220k</span>
            </div>
        </div>
    </div>
</div>
<p class="text-xs text-[#8A6477] mt-2"><em>*Teknologi modern untuk kulit wajah cerah glowing maksimal dan kulit mulus bebas bulu.</em></p>
',
                'starts_at' => now()->startOfMonth(),
                'ends_at' => now()->endOfMonth()->addDays(60),
                'is_active' => true,
                'sort_order' => 4,
            ]
        );
    }
}
