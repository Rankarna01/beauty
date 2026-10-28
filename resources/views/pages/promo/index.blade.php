@extends('layouts.app')

@section('content')
<div class="w-full flex flex-col bg-[#FFF5F9] min-h-screen">

    <!-- Top Navigation Header -->
    <div class="sticky top-0 z-30 bg-white/95 backdrop-blur-md border-b border-[#FFE4EF] px-4 py-3 flex items-center justify-between shadow-xs">
        <a href="{{ route('home') }}" class="flex items-center gap-1.5 text-[#C2095F] hover:text-[#E6107A] font-semibold text-xs tracking-tight transition-colors">
            <svg class="w-4 h-4 fill-none stroke-currentColor stroke-2" viewBox="0 0 24 24">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            <span>Beranda</span>
        </a>

        <h1 class="font-['Playfair_Display'] text-base sm:text-lg font-bold text-[#C2095F] tracking-wide">
            Promo Spesial Bulan Ini
        </h1>

        <div class="w-12"></div>
    </div>

    <!-- Header Banner Card (Pure Typography & Luxury Pink-Gold Accent, No Photos) -->
    <div class="px-4 pt-3.5 pb-1">
        <div class="w-full bg-gradient-to-r from-[#FFF5F9] via-[#FFE4EF]/80 to-[#FFF5F9] border border-[#E5C578] rounded-3xl p-4 sm:p-5 text-center shadow-xs">
            <span class="text-xs font-black uppercase tracking-wider text-[#C2095F] inline-flex items-center gap-1.5">
                <span>👑</span> PROMO SPESIAL BULAN INI
            </span>
            <h2 class="font-['Playfair_Display'] text-lg sm:text-xl font-bold text-[#3B1A2B] mt-1 leading-snug">
                Daftar Menu & Paket Hemat Putri Beauty Care
            </h2>
            <p class="text-xs text-[#8A6477] mt-1 max-w-md mx-auto leading-relaxed">
                Nikmati penawaran harga spesial untuk perawatan rambut, kuku, wajah & spa. Berlaku selama kuota promo tersedia.
            </p>
        </div>
    </div>

    <!-- Content Body (Manjang Kebawah, Bersih & Tanpa Gambar) -->
    <div class="p-4 sm:p-5 flex flex-col gap-4">

        @if($promos->isEmpty())
            <div class="w-full py-16 flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 rounded-full bg-pink-100 flex items-center justify-center text-pink-400 mb-3">
                    <svg class="w-8 h-8 fill-none stroke-currentColor stroke-1.5" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                </div>
                <h3 class="font-bold text-sm text-[#3B1A2B]">Belum Ada Promo Aktif</h3>
                <p class="text-xs text-[#8A6477] mt-1 max-w-xs">
                    Promo menarik bulan berikutnya akan segera hadir. Pantau terus Instagram kami!
                </p>
                <a href="{{ route('home') }}" class="mt-4 px-4 py-1.5 rounded-full bg-[#E6107A] text-white text-xs font-semibold hover:bg-[#C2095F]">
                    Kembali ke Beranda
                </a>
            </div>
        @else
            @foreach($promos as $promo)
                <div class="bg-white rounded-3xl gold-border overflow-hidden shadow-xs hover:shadow-md transition-all duration-200 flex flex-col p-4 sm:p-5">
                    
                    <!-- Card Top Header (Periode & Countdown Badge) -->
                    <div class="flex items-center justify-between gap-2 border-b border-pink-100 pb-2.5">
                        <span class="text-[10px] sm:text-[11px] text-[#8A6477] font-semibold uppercase tracking-wider flex items-center gap-1">
                            <i class="fa-regular fa-calendar text-[10px] text-[#C2095F]"></i>
                            <span>s/d {{ $promo->ends_at->isoFormat('D MMMM Y') }}</span>
                        </span>

                        <span class="bg-[#FFF0F6] text-[#C2095F] border border-pink-200 text-[10px] font-bold px-2.5 py-0.5 rounded-full flex items-center gap-1">
                            <span>⏳</span> {{ $promo->days_remaining }} hari lagi
                        </span>
                    </div>

                    <!-- Promo Title & Summary -->
                    <div class="mt-3">
                        <h2 class="font-['Playfair_Display'] font-bold text-base sm:text-lg text-[#3B1A2B] leading-snug">
                            <a href="{{ route('promo.show', $promo->slug) }}" class="hover:text-[#E6107A] transition-colors">
                                {{ $promo->title }}
                            </a>
                        </h2>

                        @if($promo->summary)
                            <p class="text-xs text-[#8A6477] mt-1 leading-relaxed">
                                {{ $promo->summary }}
                            </p>
                        @endif
                    </div>

                    <!-- Promo Content / Menu List (Manjang Text-Only Sesuai Flyer) -->
                    @if($promo->content)
                        <div class="mt-2 text-xs text-[#3B1A2B]">
                            {!! $promo->content !!}
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="pt-3.5 mt-2 border-t border-pink-100 flex items-center gap-2">
                        <a href="{{ route('promo.show', $promo->slug) }}" 
                           class="py-2 px-3.5 rounded-full border border-[#C2095F] text-[#C2095F] hover:bg-pink-50 text-xs font-semibold transition-colors text-center whitespace-nowrap">
                            Detail & S&K
                        </a>

                        @php
                            $promoWaUrl = \App\Services\WhatsAppLink::build('promo_claim', [
                                'promo_title' => $promo->title,
                            ]);
                        @endphp
                        <a href="{{ $promoWaUrl }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="flex-1 flex items-center justify-center gap-1.5 py-2 px-4 rounded-full bg-gradient-to-r from-[#25D366] to-[#128C7E] hover:from-[#20bd5a] hover:to-[#0f7a6d] text-white text-xs font-bold shadow-xs hover:shadow transition-all whitespace-nowrap">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                            <span>Klaim Promo Ini</span>
                        </a>
                    </div>

                </div>
            @endforeach
        @endif

    </div>

</div>
@endsection
