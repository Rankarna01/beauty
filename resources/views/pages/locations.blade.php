@extends('layouts.app')

@section('content')
<div class="w-full flex flex-col bg-[#FFF5F9] min-h-screen">

    <!-- Top Navigation Header -->
    <div class="sticky top-0 z-30 bg-white/95 backdrop-blur-md border-b border-[#FFE4EF] px-4 py-3 flex items-center justify-between shadow-xs">
        <a href="{{ route('home') }}" 
           class="w-8 h-8 rounded-full bg-[#FFF0F6] text-[#C2095F] hover:bg-[#FFE4EF] hover:text-[#E6107A] flex items-center justify-center transition-all shadow-xs"
           aria-label="Kembali ke Beranda">
            <i class="fa-solid fa-arrow-left text-xs"></i>
        </a>

        <h1 class="font-['Playfair_Display'] text-base sm:text-lg font-bold text-[#C2095F] tracking-wide">
            Lokasi & Jam Operasional
        </h1>

        <div class="w-8"></div>
    </div>

    <!-- Content Body -->
    <div class="p-4 sm:p-5 flex flex-col gap-5">

        @foreach($locations as $loc)
            <div class="bg-white rounded-3xl gold-border overflow-hidden shadow-sm flex flex-col">
                
                <!-- Location Photo / Map Header -->
                <div class="relative w-full aspect-video bg-[#FFF5F9] overflow-hidden">
                    @php
                        $locImg = $loc->photo_path 
                            ? asset('storage/' . $loc->photo_path)
                            : asset('images/putri_salon_reception.jpg');
                    @endphp
                    <img src="{{ $locImg }}" 
                         alt="{{ $loc->name }}" 
                         class="w-full h-full object-cover">
                    
                    @if($loc->is_main_branch)
                        <div class="absolute top-3 left-3 bg-gradient-to-r from-[#FF1A8C] to-[#C2095F] text-white text-[11px] font-bold px-3 py-1 rounded-full shadow-md border border-white/40 flex items-center gap-1.5">
                            <i class="fa-solid fa-crown text-amber-300 text-xs"></i>
                            <span>Cabang Utama</span>
                        </div>
                    @endif

                    <div class="absolute bottom-3 right-3 bg-black/60 backdrop-blur-xs text-white text-xs font-semibold px-3 py-1 rounded-full flex items-center gap-1.5">
                        <i class="fa-solid fa-location-dot text-[#FF85C0] text-xs"></i>
                        <span>{{ $loc->city }}</span>
                    </div>
                </div>

                <!-- Info Details -->
                <div class="p-4 sm:p-5 flex flex-col gap-4">
                    <div>
                        <h2 class="font-['Playfair_Display'] font-bold text-lg sm:text-xl text-[#3B1A2B] leading-snug">
                            {{ $loc->name }}
                        </h2>
                        
                        <!-- Address -->
                        <div class="mt-2.5 flex items-start gap-2.5">
                            <div class="w-7 h-7 rounded-full bg-pink-100/80 text-[#E6107A] flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fa-solid fa-location-dot text-xs"></i>
                            </div>
                            <span class="text-xs text-[#6B4B5E] leading-relaxed font-medium">
                                {{ $loc->address }}, {{ $loc->city }}
                            </span>
                        </div>

                        <!-- Phone / WhatsApp -->
                        @if($loc->phone)
                            <div class="mt-2 flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-full bg-emerald-100/80 text-[#25D366] flex items-center justify-center flex-shrink-0">
                                    <i class="fa-brands fa-whatsapp text-sm"></i>
                                </div>
                                <span class="text-xs text-[#3B1A2B] font-bold">
                                    WhatsApp: <a href="https://wa.me/{{ \App\Services\WhatsAppLink::cleanPhoneNumber($loc->phone) }}" target="_blank" rel="noopener noreferrer" class="text-[#0E9447] hover:underline">{{ $loc->phone }}</a>
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Direct Action Buttons -->
                    <div class="grid grid-cols-2 gap-2.5 pt-1">
                        <a href="{{ $loc->maps_url ?? 'https://maps.google.com/?q=Putri+Beauty+Care+Banda+Aceh' }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="flex items-center justify-center gap-2 py-3 px-3.5 rounded-full bg-gradient-to-r from-[#FF1A8C] to-[#C2095F] hover:from-[#e0147a] hover:to-[#a90752] text-white text-xs font-bold shadow-md hover:shadow-lg transition-all active:scale-95">
                            <i class="fa-solid fa-map-location-dot text-sm"></i>
                            <span>Buka Google Maps</span>
                        </a>

                        <a href="https://wa.me/{{ \App\Services\WhatsAppLink::cleanPhoneNumber($loc->phone ?? setting('contact.whatsapp_main', '6281362673728')) }}?text={{ rawurlencode('Halo admin, saya ingin tanya rute dan lokasi salon Putri Beauty Care.') }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="flex items-center justify-center gap-2 py-3 px-3.5 rounded-full bg-gradient-to-r from-[#25D366] to-[#128C7E] hover:from-[#20bd5a] hover:to-[#0f7a6d] text-white text-xs font-bold shadow-md hover:shadow-lg transition-all active:scale-95">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                            <span>Chat Cabang</span>
                        </a>
                    </div>

                    <!-- Weekly Operating Hours Schedule -->
                    <div class="bg-[#FFF9FB] p-4 rounded-2xl border border-pink-100">
                        <div class="flex items-center justify-between mb-2.5">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-pink-100 text-[#C2095F] flex items-center justify-center">
                                    <i class="fa-solid fa-clock text-xs"></i>
                                </div>
                                <h4 class="font-bold text-xs text-[#C2095F] uppercase tracking-wider">
                                    Jadwal Operasional Lengkap
                                </h4>
                            </div>
                            <span class="text-[10px] px-2 py-0.5 rounded-full bg-pink-100/70 text-[#C2095F] font-bold">
                                WIB
                            </span>
                        </div>
                        
                        @php
                            $todayDayOfWeek = now()->dayOfWeek; // 0 = Minggu, 1 = Senin, ...
                        @endphp

                        <div class="divide-y divide-pink-100/60 text-xs">
                            @foreach($loc->operatingHours as $schedule)
                                @php
                                    $isToday = ($schedule->day_of_week === $todayDayOfWeek);
                                @endphp
                                <div class="py-1.5 flex items-center justify-between {{ $isToday ? 'bg-pink-50/80 -mx-2 px-2 rounded-lg font-bold' : '' }}">
                                    <div class="flex items-center gap-1.5">
                                        @if($isToday)
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#25D366]"></span>
                                        @endif
                                        <span class="{{ $isToday ? 'text-[#C2095F]' : 'font-medium text-[#3B1A2B]' }}">
                                            {{ $schedule->day_name }}
                                            @if($isToday)
                                                <span class="text-[10px] font-semibold text-[#E6107A] bg-pink-100 px-1.5 py-0.2 rounded-full ml-1">Hari Ini</span>
                                            @endif
                                        </span>
                                    </div>
                                    <span class="{{ $schedule->is_closed ? 'text-gray-400 font-normal' : ($isToday ? 'text-[#C2095F] font-extrabold' : 'text-[#8A6477] font-semibold') }}">
                                        {{ $schedule->formatted_hours }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Google Maps Lazy Loaded Iframe Embed -->
                    <div class="flex flex-col gap-1.5 pt-1">
                        <div class="flex items-center gap-1.5 text-xs font-semibold text-[#8A6477] px-1">
                            <i class="fa-solid fa-map-pin text-[#E6107A] text-xs"></i>
                            <span>Peta Lokasi & Navigasi Rute:</span>
                        </div>

                        <div class="rounded-2xl overflow-hidden border border-pink-100 aspect-video w-full bg-gray-100 shadow-inner">
                            @php
                                $embedUrl = $loc->clean_embed_url;
                                if (empty($embedUrl)) {
                                    $embedUrl = 'https://maps.google.com/maps?q=' . urlencode($loc->name . ' ' . $loc->address . ' ' . $loc->city) . '&t=&z=16&ie=UTF8&iwloc=&output=embed';
                                }
                            @endphp
                            <iframe src="{{ $embedUrl }}" 
                                    width="100%" 
                                    height="100%" 
                                    style="border:0; min-height: 240px;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>

                </div>

            </div>
        @endforeach

    </div>

</div>
@endsection
