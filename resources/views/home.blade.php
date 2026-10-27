@extends('layouts.app')

@section('content')
<div class="relative w-full flex flex-col bg-[#FFF5F9] min-h-screen">

    <!-- ========================================================================= -->
    <!-- 1. HERO BANNER (Official Graphic Poster with Interactive Hotspots)       -->
    <!-- ========================================================================= -->
    <header class="relative w-full overflow-hidden shadow-md select-none bg-[#FFF5F9]" style="aspect-ratio: 436 / 220;">
        
        <!-- High-Definition Clean Graphic Banner Matching Reference Poster -->
        <img src="{{ asset('images/putri_header_banner.png') }}" 
             alt="{{ $brandName }} – {{ $tagline }}" 
             class="w-full h-full object-cover block select-none pointer-events-none"
             draggable="false">

        <!-- Hidden Semantic Heading for SEO & Screen Readers -->
        <div class="sr-only">
            <h1>{{ $brandName }} BEAUTY CARE</h1>
            <p>{{ $tagline }}</p>
            <p>Facial Treatment • Hair Cut • Creambath • Hairmask • Manicure • Nail Art • Head Spa</p>
            <p>Cantik Sehat Percaya Diri ♡ Setiap Hari</p>
            <p>WhatsApp: {{ $phoneMain }} (081362673728)</p>
            <p>Lokasi: {{ $location?->name ?? 'Head Japanese Spa' }} - {{ $location?->address ?? 'Jl. Sultan Iskandar Muda, Banda Aceh' }}</p>
        </div>

        <!-- Interactive Clickable Hotspots overlaying the Capsule Pill -->
        <!-- 1. WhatsApp Button Hotspot -->
        <a href="https://wa.me/{{ $cleanPhone }}?text={{ rawurlencode('Halo Putri Beauty Care, saya ingin bertanya seputar layanan salon & skincare.') }}" 
           target="_blank" 
           rel="noopener noreferrer"
           aria-label="Chat WhatsApp Putri Beauty Care {{ $phoneMain }}"
           title="WhatsApp: {{ $phoneMain }}"
           class="absolute z-20 rounded-full focus:outline-none focus:ring-2 focus:ring-emerald-400 cursor-pointer active:scale-95 transition-transform"
           style="left: 12%; top: 76%; width: 29%; height: 16%;">
            <span class="sr-only">Hubungi WhatsApp {{ $phoneMain }}</span>
        </a>

        <!-- 2. Location Button Hotspot -->
        <a href="{{ $location?->maps_url ?? 'https://maps.google.com/?q=Putri+Beauty+Care+Banda+Aceh' }}" 
           target="_blank" 
           rel="noopener noreferrer"
           aria-label="Petunjuk Arah Google Maps {{ $location?->name ?? 'Head Japanese Spa' }}"
           title="Petunjuk Arah: {{ $location?->name ?? 'Head Japanese Spa' }}"
           class="absolute z-20 rounded-full focus:outline-none focus:ring-2 focus:ring-pink-400 cursor-pointer active:scale-95 transition-transform"
           style="left: 42%; top: 76%; width: 34%; height: 16%;">
            <span class="sr-only">Lokasi {{ $location?->name ?? 'Head Japanese Spa' }}</span>
        </a>

    </header>


    <!-- ========================================================================= -->
    <!-- 3. THE 8 MENU PILL BUTTONS (2-Column Grid Matching the Reference Poster)   -->
    <!-- ========================================================================= -->
    <main class="w-full px-3 sm:px-4 mt-2.5 sm:mt-3.5 pb-6">
        <div class="grid grid-cols-2 gap-2.5 sm:gap-3.5">

            @foreach($menuLinks as $link)
                @php
                    $iconKey = strtolower($link->icon ?? 'sparkles');
                    $labelUpper = strtoupper($link->label);
                @endphp

                <a href="{{ url($link->url) }}"
                   class="group relative flex items-center justify-between p-2 sm:p-2.5 bg-white hover:bg-rose-50/50 rounded-full border border-[#E5C578]/80 shadow-[0_4px_12px_rgba(230,16,122,0.06)] hover:border-[#C9A24B] hover:shadow-[0_6px_18px_rgba(230,16,122,0.12)] transition-all duration-200 transform hover:-translate-y-0.5">
                    
                    <div class="flex items-center gap-2 sm:gap-2.5 overflow-hidden">
                        
                        <!-- Circular Magenta Badge with Crisp White SVG Icon -->
                        <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-gradient-to-br from-[#FF1A8C] via-[#E6107A] to-[#C2095F] text-white flex items-center justify-center shadow-md flex-shrink-0 group-hover:scale-105 transition-transform p-1.5">
                            @if(str_contains($iconKey, 'calendar') || str_contains($iconKey, 'book'))
                                <!-- 1. Calendar Check Icon -->
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                    <path d="M9 16l2 2 4-4"/>
                                </svg>
                            @elseif(str_contains($iconKey, 'tag') || str_contains($iconKey, 'harga') || str_contains($iconKey, 'price') || str_contains($iconKey, 'clipboard'))
                                <!-- 2. Price Tag Icon -->
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                                    <circle cx="7" cy="7" r="1.5" fill="#FFFFFF"/>
                                </svg>
                            @elseif(str_contains($iconKey, 'percent') || str_contains($iconKey, 'promo') || str_contains($iconKey, 'discount'))
                                <!-- 3. Discount Percent Badge Icon -->
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="15" y1="9" x2="9" y2="15"/>
                                    <circle cx="9.5" cy="9.5" r="1" fill="#FFFFFF"/>
                                    <circle cx="14.5" cy="14.5" r="1" fill="#FFFFFF"/>
                                </svg>
                            @elseif(str_contains($iconKey, 'facial') || str_contains($iconKey, 'skincare') || str_contains($iconKey, 'face'))
                                <!-- 4. Skincare & Facial Silhouette Icon -->
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2a6 6 0 0 0-6 6c0 4.5 3 8 6 10 3-2 6-5.5 6-10a6 6 0 0 0-6-6z"/>
                                    <path d="M9 11c.5 1 2 1 3 0"/>
                                    <circle cx="10" cy="8.5" r="0.8" fill="#FFFFFF"/>
                                    <circle cx="14" cy="8.5" r="0.8" fill="#FFFFFF"/>
                                </svg>
                            @elseif(str_contains($iconKey, 'spa') || str_contains($iconKey, 'hair') || str_contains($iconKey, 'nail') || str_contains($iconKey, 'heart'))
                                <!-- 5. Hair, Nail & Spa Silhouette Icon -->
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 21a9 9 0 0 0 9-9c0-4.97-4.03-9-9-9s-9 4.03-9 9a9 9 0 0 0 9 9z"/>
                                    <path d="M8 12c1.5 2 4.5 2 6 0"/>
                                    <path d="M12 3v5"/>
                                    <path d="M15 6l-3 2"/>
                                </svg>
                            @elseif(str_contains($iconKey, 'whatsapp') || str_contains($iconKey, 'chat'))
                                <!-- 6. WhatsApp Chat Bubble Icon -->
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                                </svg>
                            @elseif(str_contains($iconKey, 'location') || str_contains($iconKey, 'map') || str_contains($iconKey, 'pin'))
                                <!-- 7. Location Pin Icon -->
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                            @elseif(str_contains($iconKey, 'instagram') || str_contains($iconKey, 'camera'))
                                <!-- 8. Instagram Camera Icon -->
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                                    <circle cx="12" cy="12" r="4"/>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                                </svg>
                            @else
                                <!-- Default Sparkle Icon -->
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2l2.4 5.2L20 8.5l-4 4 1 5.5-5-3-5 3 1-5.5-4-4 5.6-1.3z"/>
                                </svg>
                            @endif
                        </div>

                        <!-- Labels -->
                        <div class="flex flex-col text-left leading-tight min-w-0">
                            <span class="font-extrabold text-[10px] sm:text-[11.5px] text-[#C2095F] tracking-tight truncate">
                                {{ $link->label }}
                            </span>
                            @if($link->description)
                                <span class="text-[8px] sm:text-[9.5px] text-[#8A6477] mt-0.5 truncate">
                                    {{ $link->description }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Right Red/Magenta Arrow -->
                    <div class="text-[#E6107A] font-bold text-xs sm:text-sm pr-1 group-hover:translate-x-1 transition-transform">
                        ›
                    </div>
                </a>
            @endforeach

        </div>


        <!-- ========================================================================= -->
        <!-- 4. OPERATING HOURS CARD (Stadium Pill + 3D Gold Clock + Floral Ribbons)   -->
        <!-- ========================================================================= -->
        <div class="mt-8 mb-3 relative w-full">
            
            <!-- Floating Top Badge: Crown + JAM OPERASIONAL -->
            <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 z-20 flex items-center gap-1.5 bg-gradient-to-r from-[#FF1A8C] via-[#E6107A] to-[#C2095F] text-white px-5 py-1.5 rounded-full shadow-md border border-[#F7E7B4]">
                <span class="text-xs">👑</span>
                <span class="font-extrabold text-[11px] sm:text-xs tracking-wider uppercase drop-shadow-xs">
                    JAM OPERASIONAL
                </span>
            </div>

            <!-- Stadium Card Container with Golden Border and Floral Ribbon Graphic -->
            <div class="relative w-full rounded-full border-2 border-[#E5C07B] shadow-lg overflow-hidden bg-[#FFF5F9]">
                
                <!-- Background Banner with Lush Floral Ribbons on Both Sides -->
                <div class="absolute inset-0 bg-cover bg-center opacity-70 pointer-events-none" 
                     style="background-image: url('{{ asset('images/floral_ribbon_banner.jpg') }}');"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-[#FFF7FA]/90 to-transparent pointer-events-none"></div>

                <!-- Card Content -->
                <div class="relative z-10 px-5 sm:px-8 py-4 pt-6 sm:pt-7 flex flex-col items-center justify-center">
                    
                    <!-- Middle Horizontal Row: 3D Gold Alarm Clock + Hours -->
                    <div class="flex items-center justify-center gap-3 sm:gap-4 my-1 w-full max-w-sm mx-auto">
                        
                        <!-- 3D Vintage Gold Alarm Clock with Twin Bells -->
                        <div class="w-13 h-13 sm:w-16 sm:h-16 flex-shrink-0 drop-shadow-md">
                            <img src="{{ asset('images/gold_alarm_clock.jpg') }}" alt="Jam Operasional" class="w-full h-full object-contain rounded-full">
                        </div>

                        <!-- Schedule: SENIN - MINGGU | 09.00 - 21.00 WIB -->
                        <div class="flex items-center gap-2 sm:gap-3">
                            <div class="bg-[#FFE4EF] text-[#C2095F] font-extrabold text-xs sm:text-sm px-3.5 sm:px-4 py-1.5 rounded-full border border-pink-200/90 shadow-xs tracking-tight whitespace-nowrap">
                                SENIN - MINGGU
                            </div>

                            <div class="h-8 w-[1.5px] bg-[#C2095F]/30 flex-shrink-0"></div>

                            <div class="flex flex-col items-center justify-center leading-none text-[#C2095F] text-center">
                                <span class="font-black text-base sm:text-xl tracking-tight">09.00 - 21.00</span>
                                <span class="font-bold text-[10px] sm:text-xs text-[#C2095F]/85 tracking-widest mt-1">WIB</span>
                            </div>
                        </div>

                    </div>

                    <!-- Bottom Elegant Script with Horizontal Divider Lines -->
                    <div class="flex items-center justify-center gap-2 sm:gap-3 mt-2.5 w-full">
                        <span class="h-[1px] w-8 sm:w-16 bg-[#C2095F]/30"></span>
                        <span class="font-['Great_Vibes'] text-base sm:text-lg text-[#C2095F] tracking-wide whitespace-nowrap">
                            Kami siap melayani kamu ♥
                        </span>
                        <span class="h-[1px] w-8 sm:w-16 bg-[#C2095F]/30"></span>
                    </div>

                </div>
            </div>
        </div>

    </main>


    <!-- ========================================================================= -->
    <!-- 5. FOOTER SECTION (Curved Magenta Wave + 3 Badges + Follow For More)      -->
    <!-- ========================================================================= -->
    <footer class="w-full bg-gradient-to-r from-[#E6107A] via-[#C2095F] to-[#A0074E] text-white pt-5 pb-6 px-4 relative overflow-hidden mt-auto rounded-t-3xl shadow-inner">
        
        <!-- Curved Gold Accent Ribbon Line -->
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#FDF3CF] via-[#C9A24B] to-[#FDF3CF]"></div>

        <div class="flex items-center justify-between gap-2 max-w-lg mx-auto">
            
            <!-- Left: Crown + Your Beauty Our Care -->
            <div class="flex flex-col items-start leading-none">
                <span class="text-xs text-[#F7E7B4]">👑</span>
                <span class="font-['Great_Vibes'] text-xl sm:text-2xl text-white tracking-wide mt-0.5">
                    {{ $slogan }} ♡
                </span>
            </div>

            <!-- Center: 3 Circular Badges (Salon, Skincare, Aesthetic) -->
            <div class="flex items-center gap-2 sm:gap-3">
                
                <!-- Salon -->
                <div class="flex flex-col items-center gap-0.5">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full border border-white/70 bg-white/15 flex items-center justify-center shadow-xs">
                        <svg class="w-3.5 h-3.5 text-white" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2a5 5 0 0 1 5 5v1a5 5 0 0 1-10 0V7a5 5 0 0 1 5-5z"/>
                            <path d="M4 22v-2a8 8 0 0 1 16 0v2"/>
                        </svg>
                    </div>
                    <span class="text-[9px] font-medium tracking-tight text-white/95">Salon</span>
                </div>

                <!-- Skincare -->
                <div class="flex flex-col items-center gap-0.5">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full border border-white/70 bg-white/15 flex items-center justify-center shadow-xs">
                        <svg class="w-3.5 h-3.5 text-white" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/>
                            <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>
                        </svg>
                    </div>
                    <span class="text-[9px] font-medium tracking-tight text-white/95">Skincare</span>
                </div>

                <!-- Aesthetic -->
                <div class="flex flex-col items-center gap-0.5">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full border border-white/70 bg-white/15 flex items-center justify-center shadow-xs">
                        <svg class="w-3.5 h-3.5 text-white" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2l2.4 5.2L20 8.5l-4 4 1 5.5-5-3-5 3 1-5.5-4-4 5.6-1.3z"/>
                        </svg>
                    </div>
                    <span class="text-[9px] font-medium tracking-tight text-white/95">Aesthetic</span>
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
