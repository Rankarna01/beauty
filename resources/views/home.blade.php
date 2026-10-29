@extends('layouts.app')

@section('content')
<div class="relative w-full flex flex-col bg-[#FFF5F9] min-h-screen">

    <!-- ========================================================================= -->
    <!-- 1. HERO BANNER (Crisp Ultra-HD Banner + Dynamic Interactive Capsule Pill) -->
    <!-- ========================================================================= -->
    <header class="relative w-full overflow-hidden select-none bg-[#FFF5F9] border-none outline-none shadow-none" style="aspect-ratio: 436 / 220; border: none !important; outline: none !important; box-shadow: none !important;">
        
        <!-- High-Definition Clean Graphic Banner (Clean Background without static pill) -->
        <img src="{{ asset('images/putri_header_banner_crisp_clean.png') }}" 
             alt="{{ $brandName }} – {{ $tagline }}" 
             class="w-full h-full object-cover block select-none pointer-events-none border-none outline-none"
             style="border: none !important; outline: none !important;"
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

        <!-- Dynamic Real HTML Button Capsule (WhatsApp & Location) - Compact & Sejajar -->
        <div class="absolute z-20" style="left: 50%; transform: translateX(-50%); bottom: 2%; width: 86%; max-width: 360px;">
            <div class="w-full bg-white rounded-full py-1 px-2.5 sm:py-1.5 sm:px-3.5 flex items-center justify-between gap-1.5 sm:gap-2"
                 style="border: none !important; outline: none !important; box-shadow: 0 3px 14px rgba(220, 20, 110, 0.15); -webkit-font-smoothing: antialiased;">
                
                <!-- 1. Dynamic WhatsApp Button -->
                <a href="https://wa.me/{{ $cleanPhone }}?text={{ rawurlencode('Halo Putri Beauty Care, saya ingin bertanya seputar layanan salon & skincare.') }}" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   aria-label="Chat WhatsApp Putri Beauty Care {{ $phoneMain }}"
                   title="WhatsApp: {{ $phoneMain }}"
                   class="flex items-center gap-1 sm:gap-1.5 rounded-full hover:opacity-90 active:scale-95 transition-all group flex-shrink-0"
                   style="border: none !important; outline: none !important;">
                    
                    <!-- Solid Green WA Circular Badge using FontAwesome (Compact & Crisp) -->
                    <div class="w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-[#25D366] text-white flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform"
                         style="border: none !important; outline: none !important; box-shadow: 0 1.5px 4px rgba(37, 211, 102, 0.3);">
                        <i class="fa-brands fa-whatsapp text-white text-[11px] sm:text-[13px] leading-none"></i>
                    </div>

                    <!-- Bold Hot Pink Phone Number -->
                    <span class="font-extrabold text-[10px] sm:text-[12px] text-[#E6107A] tracking-tight leading-none whitespace-nowrap">
                        {{ preg_replace('/^62/', '0', $phoneMain) }}
                    </span>
                </a>

                <!-- Vertical Divider Line -->
                <div class="h-3.5 sm:h-4.5 w-[1px] bg-[#E6107A]/25 flex-shrink-0"></div>

                <!-- 2. Dynamic Location Button -->
                <a href="{{ $location?->maps_url ?? 'https://maps.google.com/?q=Putri+Beauty+Care+Banda+Aceh' }}" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   aria-label="Petunjuk Arah Google Maps {{ $location?->name ?? 'Head Japanese Spa' }}"
                   title="Buka Maps: {{ $location?->name ?? 'Head Japanese Spa' }}"
                   class="flex items-center gap-1 sm:gap-1.5 rounded-full hover:opacity-90 active:scale-95 transition-all group min-w-0 flex-1"
                   style="border: none !important; outline: none !important;">
                    
                    <!-- Magenta Gradient Pin Circle with FontAwesome Location Icon (Compact & Crisp) -->
                    <div class="w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-gradient-to-br from-[#FF1A8C] to-[#C2095F] text-white flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform"
                         style="border: none !important; outline: none !important; box-shadow: 0 1.5px 4px rgba(230, 16, 122, 0.3);">
                        <i class="fa-solid fa-location-dot text-white text-[9.5px] sm:text-[11px] leading-none"></i>
                    </div>

                    <!-- Location Dynamic Typography (Sejajar, Rapi & Tidak Menumpuk) -->
                    <div class="flex flex-col text-left leading-none min-w-0 justify-center">
                        <span class="font-bold text-[8px] sm:text-[9.5px] text-[#3B1A2B] truncate block">
                            {{ $location?->name ?? 'Head Japanese Spa' }}
                        </span>
                        <span class="text-[6.8px] sm:text-[8px] text-[#8A6477] truncate block mt-0.5">
                            {{ $location?->address ?? 'Jl. Sultan Iskandar Muda, Banda Aceh' }}
                        </span>
                    </div>
                </a>

            </div>
        </div>

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

                        <!-- Schedule: SENIN - MINGGU | 09.00 - 18.00 WIB -->
                        <div class="flex items-center gap-2 sm:gap-3">
                            <div class="bg-[#FFE4EF] text-[#C2095F] font-extrabold text-xs sm:text-sm px-3.5 sm:px-4 py-1.5 rounded-full border border-pink-200/90 shadow-xs tracking-tight whitespace-nowrap">
                                SENIN - MINGGU
                            </div>

                            <div class="h-8 w-[1.5px] bg-[#C2095F]/30 flex-shrink-0"></div>

                            <div class="flex flex-col items-center justify-center leading-none text-[#C2095F] text-center">
                                <span class="font-black text-base sm:text-xl tracking-tight">09.00 - 18.00</span>
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
    <!-- 5. FOOTER SECTION (Curved Magenta Wave + Gold Ribbon + Badges)            -->
    <!-- ========================================================================= -->
    <div class="w-full mt-auto flex flex-col" style="background-color: #E6007A !important;">
        
        <!-- Liquid Metallic Gold Ribbon Wave Transition -->
        <div class="w-full overflow-hidden leading-none -mb-[1px]" style="background-color: #FFF5F9 !important;">
            <svg class="w-full h-8 sm:h-11 block" viewBox="0 0 1000 50" preserveAspectRatio="none" fill="none">
                <defs>
                    <linearGradient id="footerGoldGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#E5C578"/>
                        <stop offset="20%" stop-color="#FFF2C6"/>
                        <stop offset="45%" stop-color="#C9A24B"/>
                        <stop offset="70%" stop-color="#FDF3CF"/>
                        <stop offset="85%" stop-color="#D4AF37"/>
                        <stop offset="100%" stop-color="#9E7420"/>
                    </linearGradient>
                    <linearGradient id="footerGlintGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#FFF5D6" stop-opacity="0.3"/>
                        <stop offset="30%" stop-color="#FFFDF5" stop-opacity="0.9"/>
                        <stop offset="70%" stop-color="#FFF2C6" stop-opacity="0.4"/>
                        <stop offset="100%" stop-color="#FFFDF5" stop-opacity="0.8"/>
                    </linearGradient>
                </defs>
                <!-- Magenta Body Fill under the wave -->
                <path d="M0,28 C160,38 320,18 500,22 C680,26 840,40 1000,16 L1000,50 L0,50 Z" fill="#E6007A"/>
                
                <!-- Main Metallic Gold Ribbon Contour -->
                <path d="M0,28 C160,38 320,18 500,22 C680,26 840,40 1000,16" 
                      stroke="url(#footerGoldGrad)" 
                      stroke-width="4.5" 
                      stroke-linecap="round"/>
                
                <!-- Secondary Glint Ribbon Line -->
                <path d="M0,24 C160,34 320,14 500,18 C680,22 840,36 1000,12" 
                      stroke="url(#footerGlintGrad)" 
                      stroke-width="1.5" 
                      stroke-linecap="round"/>
            </svg>
        </div>

        <!-- Magenta Footer Body matching media_1793115200274.png (Guaranteed Solid Magenta) -->
        <footer class="w-full text-white pt-1 pb-10 sm:pb-8 px-3 sm:px-6 relative overflow-hidden"
                style="background-color: #E6007A !important; background: linear-gradient(180deg, #E6007A 0%, #D4006E 50%, #C2095F 100%) !important;">
            <div class="flex items-center justify-between gap-1.5 sm:gap-4 max-w-lg mx-auto">
                
                <!-- Left: Gold Crown + Your Beauty, Our Care ♡ -->
                <div class="flex flex-col items-start leading-none flex-shrink-0">
                    <!-- Gold Crown Icon -->
                    <svg class="w-5 h-4 sm:w-6 sm:h-5 text-[#F5D061] drop-shadow-xs -rotate-6 mb-1" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M5 16L3 5l5.5 5L12 4l3.5 6L21 5l-2 11H5zm14 3c0 .6-.4 1-1 1H6c-.6 0-1-.4-1-1v-1h14v1z"/>
                    </svg>
                    <!-- Cursive Script Slogan -->
                    <div class="font-['Great_Vibes'] text-[18px] sm:text-[23px] text-white leading-[1.08] tracking-wide">
                        <div>Your Beauty,</div>
                        <div>Our Care <span class="text-white text-base sm:text-lg">♡</span></div>
                    </div>
                </div>

                <!-- Center: 3 Circular Badges (Salon, Skincare, Aesthetic) -->
                <div class="flex items-center justify-center gap-2 sm:gap-3.5 flex-shrink-0">
                    
                    <!-- 1. Salon Badge -->
                    <a href="{{ url('/katalog') }}" class="flex flex-col items-center group transition-transform hover:scale-105">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full border-[1.5px] border-white/90 bg-white/15 flex items-center justify-center shadow-[0_2px_8px_rgba(0,0,0,0.15)]">
                            <!-- Woman with Hijab Silhouette Icon -->
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 3C8 3 6.5 6.5 6.5 10C6.5 14 8 16.5 9 18.5C10 20.5 11 21 12 21C13 21 14 20.5 15 18.5C16 16.5 17.5 14 17.5 10C17.5 6.5 16 3 12 3Z"/>
                                <path d="M8.5 7.5C10 6.5 14 6.5 15.5 7.5"/>
                                <path d="M11 9.5C12.5 10 13 11 12.8 12.5C12.5 13.5 11.8 14 11 14.5"/>
                                <path d="M9 16.5C10.5 17.8 13.5 17.8 15 16.5"/>
                            </svg>
                        </div>
                        <span class="text-[9.5px] sm:text-[11px] font-normal tracking-wide text-white mt-1">Salon</span>
                    </a>

                    <!-- 2. Skincare Badge -->
                    <a href="{{ url('/katalog') }}" class="flex flex-col items-center group transition-transform hover:scale-105">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full border-[1.5px] border-white/90 bg-white/15 flex items-center justify-center shadow-[0_2px_8px_rgba(0,0,0,0.15)]">
                            <!-- Botanical Skincare Leaves Icon -->
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 17C6.5 16.5 5 13 5.5 9.5C8.5 9 11.5 11 12 14.5"/>
                                <path d="M6 9.5C8.5 12 11 14.5 12 17"/>
                                <path d="M12 17C13 12.5 16 7.5 20 6.5C20.5 10.5 18 15 12 17Z"/>
                                <path d="M13.5 14.5C16 11.5 18 9.5 20 6.5"/>
                                <path d="M12 17V20"/>
                            </svg>
                        </div>
                        <span class="text-[9.5px] sm:text-[11px] font-normal tracking-wide text-white mt-1">Skincare</span>
                    </a>

                    <!-- 3. Aesthetic Badge -->
                    <a href="{{ url('/katalog') }}" class="flex flex-col items-center group transition-transform hover:scale-105">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full border-[1.5px] border-white/90 bg-white/15 flex items-center justify-center shadow-[0_2px_8px_rgba(0,0,0,0.15)]">
                            <!-- Sparkle Stars Icon -->
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M14 2C14 5.5 16.5 8 20 8C16.5 8 14 10.5 14 14C14 10.5 11.5 8 8 8C11.5 8 14 5.5 14 2Z"/>
                                <path d="M7 13C7 15 8.5 16.5 10.5 16.5C8.5 16.5 7 18 7 20C7 18 5.5 16.5 3.5 16.5C5.5 16.5 7 15 7 13Z"/>
                            </svg>
                        </div>
                        <span class="text-[9.5px] sm:text-[11px] font-normal tracking-wide text-white mt-1">Aesthetic</span>
                    </a>

                </div>

                <!-- Right: Follow for more ♡ + Brush Underline Accent -->
                <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" class="flex flex-col items-end leading-none hover:opacity-90 transition-opacity group flex-shrink-0">
                    <div class="font-['Great_Vibes'] text-[18px] sm:text-[23px] text-white tracking-wide text-right leading-[1.08]">
                        <div>Follow</div>
                        <div class="flex items-center gap-1 justify-end">
                            <span>for more</span>
                            <span class="text-white text-base sm:text-lg">♡</span>
                        </div>
                    </div>
                    <!-- Curved Brush Underline Accent -->
                    <svg class="w-13 sm:w-16 h-2 text-white mt-0.5 group-hover:scale-105 transition-transform" viewBox="0 0 60 8" fill="none">
                        <path d="M2 3C20 7 42 6 58 2" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </a>

            </div>
        </footer>

    </div>

</div>
@endsection
