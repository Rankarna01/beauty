@extends('layouts.app')

@section('content')
<div class="relative w-full flex flex-col bg-[#FFF5F9]">

    <!-- ========================================================================= -->
    <!-- 1. HEADER SECTION (Vibrant Pink Gradient + Brand + Interior Reception)   -->
    <!-- ========================================================================= -->
    <header class="relative w-full bg-gradient-to-br from-[#FF1A8C] via-[#E6107A] to-[#C2095F] text-white pt-7 pb-10 px-4 sm:px-6 overflow-hidden rounded-b-[2rem] shadow-md">
        
        <!-- Decorative Botanical Silhouettes -->
        <div class="absolute -top-10 -left-10 w-40 h-40 opacity-15 pointer-events-none">
            <svg viewBox="0 0 200 200" fill="white">
                <path d="M45,10 C70,40 30,80 60,110 C90,140 140,110 160,150 C180,190 120,200 80,180 C40,160 10,130 5,80 C0,30 20,-20 45,10 Z"/>
            </svg>
        </div>
        <div class="absolute -bottom-8 -right-8 w-36 h-36 opacity-10 pointer-events-none">
            <svg viewBox="0 0 200 200" fill="#FFD700">
                <circle cx="100" cy="100" r="80"/>
            </svg>
        </div>

        <div class="relative z-10 flex flex-col sm:flex-row items-center justify-between gap-4">
            
            <!-- Left Column: Brand Identity, Logo, Chips -->
            <div class="flex-1 flex flex-col items-center sm:items-start text-center sm:text-left">
                
                <!-- Crown & Monogram Emblem -->
                <div class="flex items-center gap-2 mb-1">
                    <!-- Gold Crown SVG -->
                    <svg class="w-6 h-6 text-[#F7E7B4] drop-shadow" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M5 16L3 5l5.5 5L12 4l3.5 6L21 5l-2 11H5m14 3c0 .6-.4 1-1 1H6c-.6 0-1-.4-1-1v-1h14v1z"/>
                    </svg>

                    <!-- Stylized Hijab & Face Emblem -->
                    <div class="w-9 h-9 rounded-full bg-white/20 backdrop-blur-sm border border-white/40 flex items-center justify-center p-1 shadow-inner">
                        <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12c0 3.84 2.16 7.18 5.34 8.87.27-.47.66-1.12 1.07-1.87-.27-.64-.41-1.33-.41-2 0-2.76 2.24-5 5-5s5 2.24 5 5c0 .67-.14 1.36-.41 2 .41.75.8 1.4 1.07 1.87C20.84 19.18 23 15.84 23 12c0-5.52-4.48-10-11-10z"/>
                        </svg>
                    </div>

                    <!-- Monogram Script P with Gold Leaf -->
                    <span class="font-['Great_Vibes'] text-3xl font-bold text-[#F7E7B4] ml-0.5 drop-shadow">P</span>
                </div>

                <!-- Main Brand Typography -->
                <h1 class="font-['Great_Vibes'] text-5xl sm:text-6xl text-white font-normal leading-none tracking-wide drop-shadow-md">
                    {{ $brandName }}
                </h1>
                <div class="text-xs sm:text-sm font-bold tracking-[0.25em] text-white/95 uppercase mt-1">
                    BEAUTY CARE
                </div>

                <!-- Subtitle with Gold Lines -->
                <div class="flex items-center gap-2 my-2 w-full max-w-xs justify-center sm:justify-start">
                    <span class="h-[1px] flex-1 bg-gradient-to-r from-transparent to-[#F7E7B4]"></span>
                    <span class="text-[10px] sm:text-[11px] font-semibold tracking-wider text-[#F7E7B4] uppercase whitespace-nowrap">
                        {{ $tagline }}
                    </span>
                    <span class="h-[1px] flex-1 bg-gradient-to-l from-transparent to-[#F7E7B4]"></span>
                </div>

                <!-- Featured Service Chips -->
                <div class="flex flex-wrap items-center justify-center sm:justify-start gap-1 sm:gap-1.5 mt-1 max-w-sm text-[10px] sm:text-[11px] text-white/90 font-medium">
                    @foreach($chips as $index => $chip)
                        <span>{{ $chip }}</span>
                        @if(!$loop->last)
                            <span class="text-[#F7E7B4] font-bold">•</span>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Right Column: Slogan Callout & Salon Interior Photo Mockup -->
            <div class="flex flex-col items-center sm:items-end justify-center">
                <!-- Floating Script Slogan -->
                <div class="font-['Great_Vibes'] text-xl sm:text-2xl text-white text-center sm:text-right mb-2 drop-shadow">
                    Cantik Sehat<br>Percaya Diri Setiap Hari ♡
                </div>

                <!-- Aesthetic Clinic Reception Card Mockup -->
                <div class="w-32 h-24 sm:w-36 sm:h-28 rounded-2xl overflow-hidden border-2 border-white/60 shadow-lg relative bg-gradient-to-tr from-pink-200 via-rose-100 to-pink-50 flex items-center justify-center group">
                    <!-- Stylized Salon Interior SVG Graphic -->
                    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=400&q=80');">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#C2095F]/60 via-transparent to-pink-500/20"></div>
                    </div>
                    <div class="relative z-10 text-center text-white px-2 py-1 bg-black/30 backdrop-blur-xs rounded-lg border border-white/30 text-[9px] font-semibold tracking-wider uppercase">
                        Banda Aceh
                    </div>
                </div>
            </div>

        </div>
    </header>


    <!-- ========================================================================= -->
    <!-- 2. QUICK CONTACT PILL BAR (WhatsApp & Location)                           -->
    <!-- ========================================================================= -->
    <div class="relative z-20 px-3 sm:px-4 -mt-6">
        <div class="w-full bg-white rounded-full gold-border shadow-lg p-2 sm:p-2.5 flex items-center justify-between gap-1 sm:gap-2">
            
            <!-- WhatsApp Action -->
            <a href="https://wa.me/{{ $cleanPhone }}?text={{ rawurlencode('Halo Putri Beauty Care, saya ingin bertanya seputar layanan salon & skincare.') }}" 
               target="_blank" 
               rel="noopener noreferrer"
               class="flex-1 flex items-center justify-center gap-2 py-1 px-2 rounded-full hover:bg-emerald-50 transition-colors group">
                <!-- Green WA Circle -->
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-[#25D366] text-white flex items-center justify-center shadow-md group-hover:scale-105 transition-transform flex-shrink-0">
                    <svg class="w-4 h-4 sm:w-4.5 sm:h-4.5 fill-current" viewBox="0 0 24 24">
                        <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.392-10.416c-5.514 0-10 4.486-10 10 0 1.764.459 3.421 1.261 4.869l-1.341 4.903 5.02-1.316c1.397.763 2.99 1.199 4.685 1.199 5.514 0 10-4.486 10-10s-4.486-10-10-10z"/>
                    </svg>
                </div>
                <span class="font-bold text-xs sm:text-sm text-[#3B1A2B] tracking-tight">
                    {{ $phoneMain }}
                </span>
            </a>

            <!-- Divider -->
            <div class="h-8 w-[1px] bg-gradient-to-b from-[#C9A24B]/20 via-[#C9A24B]/60 to-[#C9A24B]/20"></div>

            <!-- Location Action -->
            <a href="{{ $location?->maps_url ?? 'https://maps.google.com/?q=Putri+Beauty+Care+Banda+Aceh' }}" 
               target="_blank" 
               rel="noopener noreferrer"
               class="flex-1 flex items-center justify-center gap-2 py-1 px-2 rounded-full hover:bg-rose-50 transition-colors group">
                <!-- Pink Pin Circle -->
                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-gradient-to-br from-[#E6107A] to-[#C2095F] text-white flex items-center justify-center shadow-md group-hover:scale-105 transition-transform flex-shrink-0">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5 2.5 2.5 0 0 1 0 5z"/>
                    </svg>
                </div>
                <div class="flex flex-col text-left leading-tight">
                    <span class="font-bold text-[11px] sm:text-xs text-[#3B1A2B] line-clamp-1">
                        {{ $location?->name ?? 'Head Japanese Spa' }}
                    </span>
                    <span class="text-[9px] sm:text-[10px] text-[#8A6477] line-clamp-1">
                        {{ $location?->address ?? 'Jl. Sultan Iskandar Muda, Banda Aceh' }}
                    </span>
                </div>
            </a>

        </div>
    </div>


    <!-- ========================================================================= -->
    <!-- 3. THE 8 MENU PILL BUTTONS (2-Column Grid Matching the Poster)            -->
    <!-- ========================================================================= -->
    <main class="w-full px-3 sm:px-4 mt-5 pb-6">
        <div class="grid grid-cols-2 gap-2.5 sm:gap-3.5">

            <!-- 1. BOOKING SALON & SKINCARE -->
            <a href="{{ url('/booking') }}"
               class="group relative flex items-center justify-between p-2 sm:p-2.5 bg-white hover:bg-rose-50/40 rounded-full gold-border transition-all duration-200 transform hover:-translate-y-0.5">
                <div class="flex items-center gap-2 sm:gap-2.5 overflow-hidden">
                    <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-gradient-to-br from-[#FF1493] via-[#E6107A] to-[#C2095F] text-white flex items-center justify-center shadow-md flex-shrink-0 group-hover:rotate-6 transition-transform">
                        <!-- Calendar Icon -->
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-none stroke-currentColor stroke-2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </div>
                    <div class="flex flex-col text-left leading-none min-w-0">
                        <span class="font-bold text-[10px] sm:text-[11.5px] text-[#C2095F] tracking-tight truncate">
                            BOOKING
                        </span>
                        <span class="font-bold text-[9px] sm:text-[10.5px] text-[#C2095F] tracking-tight truncate">
                            SALON & SKINCARE
                        </span>
                        <span class="text-[8px] sm:text-[9.5px] text-[#8A6477] mt-0.5 truncate">
                            Pilih jadwal kamu sekarang
                        </span>
                    </div>
                </div>
                <div class="text-[#E6107A] font-bold text-xs sm:text-sm pr-1.5 group-hover:translate-x-1 transition-transform">
                    ›
                </div>
            </a>

            <!-- 2. DAFTAR HARGA TREATMENT -->
            <a href="{{ url('/harga') }}"
               class="group relative flex items-center justify-between p-2 sm:p-2.5 bg-white hover:bg-rose-50/40 rounded-full gold-border transition-all duration-200 transform hover:-translate-y-0.5">
                <div class="flex items-center gap-2 sm:gap-2.5 overflow-hidden">
                    <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-gradient-to-br from-[#FF1493] via-[#E6107A] to-[#C2095F] text-white flex items-center justify-center shadow-md flex-shrink-0 group-hover:rotate-6 transition-transform">
                        <!-- Price Tag Icon -->
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-none stroke-currentColor stroke-2" viewBox="0 0 24 24">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                            <line x1="7" y1="7" x2="7.01" y2="7"/>
                        </svg>
                    </div>
                    <div class="flex flex-col text-left leading-none min-w-0">
                        <span class="font-bold text-[10px] sm:text-[11.5px] text-[#C2095F] tracking-tight truncate">
                            DAFTAR HARGA
                        </span>
                        <span class="font-bold text-[9px] sm:text-[10.5px] text-[#C2095F] tracking-tight truncate">
                            TREATMENT
                        </span>
                        <span class="text-[8px] sm:text-[9.5px] text-[#8A6477] mt-0.5 truncate">
                            Lihat semua layanan & harga
                        </span>
                    </div>
                </div>
                <div class="text-[#E6107A] font-bold text-xs sm:text-sm pr-1.5 group-hover:translate-x-1 transition-transform">
                    ›
                </div>
            </a>

            <!-- 3. PROMO BULAN INI -->
            <a href="{{ url('/promo') }}"
               class="group relative flex items-center justify-between p-2 sm:p-2.5 bg-white hover:bg-rose-50/40 rounded-full gold-border transition-all duration-200 transform hover:-translate-y-0.5">
                <div class="flex items-center gap-2 sm:gap-2.5 overflow-hidden">
                    <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-gradient-to-br from-[#FF1493] via-[#E6107A] to-[#C2095F] text-white flex items-center justify-center shadow-md flex-shrink-0 group-hover:rotate-6 transition-transform">
                        <!-- Discount Percent Icon -->
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-none stroke-currentColor stroke-2" viewBox="0 0 24 24">
                            <line x1="19" y1="5" x2="5" y2="19"/>
                            <circle cx="6.5" cy="6.5" r="2.5"/>
                            <circle cx="17.5" cy="17.5" r="2.5"/>
                        </svg>
                    </div>
                    <div class="flex flex-col text-left leading-none min-w-0">
                        <span class="font-bold text-[10px] sm:text-[11.5px] text-[#C2095F] tracking-tight truncate">
                            PROMO BULAN INI
                        </span>
                        <span class="text-[8px] sm:text-[9.5px] text-[#8A6477] mt-0.5 truncate">
                            Jangan sampai kelewatan!
                        </span>
                    </div>
                </div>
                <div class="text-[#E6107A] font-bold text-xs sm:text-sm pr-1.5 group-hover:translate-x-1 transition-transform">
                    ›
                </div>
            </a>

            <!-- 4. SKINCARE & FACIAL -->
            <a href="{{ url('/katalog/skincare-facial') }}"
               class="group relative flex items-center justify-between p-2 sm:p-2.5 bg-white hover:bg-rose-50/40 rounded-full gold-border transition-all duration-200 transform hover:-translate-y-0.5">
                <div class="flex items-center gap-2 sm:gap-2.5 overflow-hidden">
                    <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-gradient-to-br from-[#FF1493] via-[#E6107A] to-[#C2095F] text-white flex items-center justify-center shadow-md flex-shrink-0 group-hover:rotate-6 transition-transform">
                        <!-- Facial / Sparkle Skin Icon -->
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-none stroke-currentColor stroke-2" viewBox="0 0 24 24">
                            <path d="M12 2l2.4 5.2L20 8.5l-4 4 1 5.5-5-3-5 3 1-5.5-4-4 5.6-1.3z"/>
                        </svg>
                    </div>
                    <div class="flex flex-col text-left leading-none min-w-0">
                        <span class="font-bold text-[10px] sm:text-[11.5px] text-[#C2095F] tracking-tight truncate">
                            SKINCARE & FACIAL
                        </span>
                        <span class="text-[8px] sm:text-[9.5px] text-[#8A6477] mt-0.5 truncate">
                            Rawat kulitmu, tampil maksimal
                        </span>
                    </div>
                </div>
                <div class="text-[#E6107A] font-bold text-xs sm:text-sm pr-1.5 group-hover:translate-x-1 transition-transform">
                    ›
                </div>
            </a>

            <!-- 5. HAIR, NAIL & SPA -->
            <a href="{{ url('/katalog/hair-nail-spa') }}"
               class="group relative flex items-center justify-between p-2 sm:p-2.5 bg-white hover:bg-rose-50/40 rounded-full gold-border transition-all duration-200 transform hover:-translate-y-0.5">
                <div class="flex items-center gap-2 sm:gap-2.5 overflow-hidden">
                    <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-gradient-to-br from-[#FF1493] via-[#E6107A] to-[#C2095F] text-white flex items-center justify-center shadow-md flex-shrink-0 group-hover:rotate-6 transition-transform">
                        <!-- Beauty / Hair / Nail Icon -->
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-none stroke-currentColor stroke-2" viewBox="0 0 24 24">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                        </svg>
                    </div>
                    <div class="flex flex-col text-left leading-none min-w-0">
                        <span class="font-bold text-[10px] sm:text-[11.5px] text-[#C2095F] tracking-tight truncate">
                            HAIR, NAIL & SPA
                        </span>
                        <span class="text-[8px] sm:text-[9.5px] text-[#8A6477] mt-0.5 truncate">
                            Perawatan lengkap untukmu
                        </span>
                    </div>
                </div>
                <div class="text-[#E6107A] font-bold text-xs sm:text-sm pr-1.5 group-hover:translate-x-1 transition-transform">
                    ›
                </div>
            </a>

            <!-- 6. KONSULTASI WHATSAPP -->
            <a href="{{ url('/konsultasi') }}"
               class="group relative flex items-center justify-between p-2 sm:p-2.5 bg-white hover:bg-rose-50/40 rounded-full gold-border transition-all duration-200 transform hover:-translate-y-0.5">
                <div class="flex items-center gap-2 sm:gap-2.5 overflow-hidden">
                    <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-gradient-to-br from-[#FF1493] via-[#E6107A] to-[#C2095F] text-white flex items-center justify-center shadow-md flex-shrink-0 group-hover:rotate-6 transition-transform">
                        <!-- Chat Bubble Icon -->
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-none stroke-currentColor stroke-2" viewBox="0 0 24 24">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                    </div>
                    <div class="flex flex-col text-left leading-none min-w-0">
                        <span class="font-bold text-[10px] sm:text-[11.5px] text-[#C2095F] tracking-tight truncate">
                            KONSULTASI WHATSAPP
                        </span>
                        <span class="text-[8px] sm:text-[9.5px] text-[#8A6477] mt-0.5 truncate">
                            Tanya langsung ke admin
                        </span>
                    </div>
                </div>
                <div class="text-[#E6107A] font-bold text-xs sm:text-sm pr-1.5 group-hover:translate-x-1 transition-transform">
                    ›
                </div>
            </a>

            <!-- 7. LOKASI SALON -->
            <a href="{{ url('/lokasi') }}"
               class="group relative flex items-center justify-between p-2 sm:p-2.5 bg-white hover:bg-rose-50/40 rounded-full gold-border transition-all duration-200 transform hover:-translate-y-0.5">
                <div class="flex items-center gap-2 sm:gap-2.5 overflow-hidden">
                    <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-gradient-to-br from-[#FF1493] via-[#E6107A] to-[#C2095F] text-white flex items-center justify-center shadow-md flex-shrink-0 group-hover:rotate-6 transition-transform">
                        <!-- Map Pin Icon -->
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-none stroke-currentColor stroke-2" viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <div class="flex flex-col text-left leading-none min-w-0">
                        <span class="font-bold text-[10px] sm:text-[11.5px] text-[#C2095F] tracking-tight truncate">
                            LOKASI SALON
                        </span>
                        <span class="text-[8px] sm:text-[9.5px] text-[#8A6477] mt-0.5 truncate">
                            Temukan kami di Google Maps
                        </span>
                    </div>
                </div>
                <div class="text-[#E6107A] font-bold text-xs sm:text-sm pr-1.5 group-hover:translate-x-1 transition-transform">
                    ›
                </div>
            </a>

            <!-- 8. INSTAGRAM PUTRI BEAUTYCARE -->
            <a href="{{ url('/instagram') }}"
               target="_blank"
               rel="noopener noreferrer"
               class="group relative flex items-center justify-between p-2 sm:p-2.5 bg-white hover:bg-rose-50/40 rounded-full gold-border transition-all duration-200 transform hover:-translate-y-0.5">
                <div class="flex items-center gap-2 sm:gap-2.5 overflow-hidden">
                    <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-gradient-to-br from-[#FF1493] via-[#E6107A] to-[#C2095F] text-white flex items-center justify-center shadow-md flex-shrink-0 group-hover:rotate-6 transition-transform">
                        <!-- Instagram Camera Icon -->
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-none stroke-currentColor stroke-2" viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                        </svg>
                    </div>
                    <div class="flex flex-col text-left leading-none min-w-0">
                        <span class="font-bold text-[10px] sm:text-[11.5px] text-[#C2095F] tracking-tight truncate">
                            INSTAGRAM
                        </span>
                        <span class="font-bold text-[9px] sm:text-[10.5px] text-[#C2095F] tracking-tight truncate">
                            PUTRI BEAUTYCARE
                        </span>
                        <span class="text-[8px] sm:text-[9.5px] text-[#8A6477] mt-0.5 truncate">
                            Lihat hasil treatment & update
                        </span>
                    </div>
                </div>
                <div class="text-[#E6107A] font-bold text-xs sm:text-sm pr-1.5 group-hover:translate-x-1 transition-transform">
                    ›
                </div>
            </a>

        </div>


        <!-- ========================================================================= -->
        <!-- 4. OPERATING HOURS CARD (Ribbon Frame + Gold Clock + Live Status)         -->
        <!-- ========================================================================= -->
        <div class="mt-6 relative">
            
            <!-- Floating Badge: Crown + JAM OPERASIONAL -->
            <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 z-10 flex items-center gap-1.5 bg-gradient-to-r from-[#FF1A8C] via-[#E6107A] to-[#C2095F] text-white px-4 py-1 rounded-full shadow-md border border-[#F7E7B4]">
                <svg class="w-3.5 h-3.5 text-[#F7E7B4]" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M5 16L3 5l5.5 5L12 4l3.5 6L21 5l-2 11H5m14 3c0 .6-.4 1-1 1H6c-.6 0-1-.4-1-1v-1h14v1z"/>
                </svg>
                <span class="font-bold text-[11px] sm:text-xs tracking-wider uppercase">
                    JAM OPERASIONAL
                </span>
            </div>

            <!-- Card Body with Gold Ribbon Border -->
            <div class="bg-gradient-to-b from-[#FFF0F6] to-white rounded-3xl p-5 pt-7 border-2 border-[#E5C07B]/70 shadow-md relative overflow-hidden text-center">
                
                <!-- Decorative Corner Ribbons / Flowers -->
                <div class="absolute -top-6 -left-6 w-16 h-16 pointer-events-none opacity-40">
                    <svg viewBox="0 0 100 100" fill="#E6107A">
                        <circle cx="50" cy="50" r="40"/>
                    </svg>
                </div>
                <div class="absolute -top-6 -right-6 w-16 h-16 pointer-events-none opacity-40">
                    <svg viewBox="0 0 100 100" fill="#E6107A">
                        <circle cx="50" cy="50" r="40"/>
                    </svg>
                </div>

                <!-- Clock Icon + Schedule Details -->
                <div class="flex items-center justify-center gap-3 sm:gap-4 my-2">
                    
                    <!-- Vintage Gold Alarm Clock Icon -->
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-gradient-to-br from-[#FDF3CF] via-[#F3D27B] to-[#C9A24B] p-0.5 shadow-md flex items-center justify-center flex-shrink-0">
                        <div class="w-full h-full rounded-full bg-white flex items-center justify-center border border-[#C9A24B]/40">
                            <svg class="w-7 h-7 text-[#C9A24B]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="13" r="8"/>
                                <path d="M12 9v4l2 2"/>
                                <path d="M5 3L2 6"/>
                                <path d="M22 6l-3-3"/>
                                <path d="M6 19l-2 2"/>
                                <path d="M18 19l2 2"/>
                            </svg>
                        </div>
                    </div>

                    <!-- SENIN - MINGGU Pill & Hours -->
                    <div class="flex flex-col sm:flex-row items-center gap-2 sm:gap-3">
                        <div class="bg-[#FFE4EF] text-[#C2095F] font-bold text-xs sm:text-sm px-3.5 py-1 rounded-full border border-pink-200 shadow-xs">
                            SENIN - MINGGU
                        </div>
                        <div class="hidden sm:block h-6 w-[1.5px] bg-[#C9A24B]/40"></div>
                        <div class="text-[#C2095F] font-bold text-sm sm:text-base tracking-wide">
                            {{ $operatingStatus['hours_text'] }}
                        </div>
                    </div>

                </div>

                <!-- Live Status Indicator (Buka / Tutup) -->
                <div class="inline-flex items-center gap-2 mt-1 px-3 py-0.5 rounded-full bg-white/80 border border-gray-200 text-[11px] font-semibold">
                    <span class="flex h-2.5 w-2.5 relative">
                        @if($operatingStatus['is_open'])
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                        @else
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-gray-400"></span>
                        @endif
                    </span>
                    <span class="{{ $operatingStatus['is_open'] ? 'text-emerald-700' : 'text-gray-500' }}">
                        {{ $operatingStatus['label'] }} (WIB)
                    </span>
                </div>

                <!-- Elegant Footer Script -->
                <div class="font-['Great_Vibes'] text-xl sm:text-2xl text-[#C2095F] mt-3">
                    Kami siap melayani kamu ♡
                </div>

            </div>
        </div>

    </main>


    <!-- ========================================================================= -->
    <!-- 5. FOOTER SECTION (Deep Magenta Wave + Icons + Follow For More)           -->
    <!-- ========================================================================= -->
    <footer class="w-full bg-[#E6107A] text-white pt-6 pb-7 px-4 relative overflow-hidden mt-auto">
        
        <!-- Curved Gold Accent Ribbon Line -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#FDF3CF] via-[#C9A24B] to-[#FDF3CF]"></div>

        <div class="flex items-center justify-between gap-2 max-w-lg mx-auto">
            
            <!-- Left: Crown + Your Beauty Our Care -->
            <div class="flex flex-col items-start leading-none">
                <svg class="w-4 h-4 text-[#F7E7B4] mb-0.5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M5 16L3 5l5.5 5L12 4l3.5 6L21 5l-2 11H5m14 3c0 .6-.4 1-1 1H6c-.6 0-1-.4-1-1v-1h14v1z"/>
                </svg>
                <span class="font-['Great_Vibes'] text-xl sm:text-2xl text-white tracking-wide">
                    {{ $slogan }} ♡
                </span>
            </div>

            <!-- Center: 3 Circular Badges (Salon, Skincare, Aesthetic) -->
            <div class="flex items-center gap-2 sm:gap-3">
                
                <!-- Salon -->
                <div class="flex flex-col items-center gap-0.5">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full border border-white/60 bg-white/10 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2a5 5 0 0 1 5 5v1a5 5 0 0 1-10 0V7a5 5 0 0 1 5-5z"/>
                            <path d="M4 22v-2a8 8 0 0 1 16 0v2"/>
                        </svg>
                    </div>
                    <span class="text-[9px] font-medium tracking-tight text-white/90">Salon</span>
                </div>

                <!-- Skincare -->
                <div class="flex flex-col items-center gap-0.5">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full border border-white/60 bg-white/10 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/>
                            <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>
                        </svg>
                    </div>
                    <span class="text-[9px] font-medium tracking-tight text-white/90">Skincare</span>
                </div>

                <!-- Aesthetic -->
                <div class="flex flex-col items-center gap-0.5">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full border border-white/60 bg-white/10 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2l2.4 5.2L20 8.5l-4 4 1 5.5-5-3-5 3 1-5.5-4-4 5.6-1.3z"/>
                        </svg>
                    </div>
                    <span class="text-[9px] font-medium tracking-tight text-white/90">Aesthetic</span>
                </div>

            </div>

            <!-- Right: Follow for more ♡ -->
            <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" class="flex flex-col items-end leading-none hover:opacity-85 transition-opacity">
                <span class="font-['Great_Vibes'] text-xl sm:text-2xl text-white tracking-wide">
                    Follow for more ♡
                </span>
                <span class="text-[9px] text-white/80 font-medium">
                    {{ '@' . $instagramUsername }}
                </span>
            </a>

        </div>

    </footer>

</div>
@endsection
