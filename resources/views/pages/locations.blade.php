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
            Lokasi & Jam Buka Salon
        </h1>

        <div class="w-12"></div>
    </div>

    <!-- Content Body -->
    <div class="p-4 sm:p-5 flex flex-col gap-5">

        @foreach($locations as $loc)
            <div class="bg-white rounded-3xl gold-border overflow-hidden shadow-sm flex flex-col">
                
                <!-- Location Photo / Map Header -->
                <div class="relative w-full aspect-video bg-pink-100 overflow-hidden">
                    @php
                        $locImg = $loc->photo_path 
                            ? asset('storage/' . $loc->photo_path)
                            : 'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80';
                    @endphp
                    <img src="{{ $locImg }}" alt="{{ $loc->name }}" class="w-full h-full object-cover">
                    
                    @if($loc->is_main_branch)
                        <div class="absolute top-3 left-3 bg-gradient-to-r from-[#FF1A8C] to-[#C2095F] text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-md border border-white/40">
                            👑 Outlet Utama
                        </div>
                    @endif

                    <div class="absolute bottom-3 right-3 bg-black/60 backdrop-blur-xs text-white text-xs font-semibold px-3 py-1 rounded-full">
                        {{ $loc->city }}
                    </div>
                </div>

                <!-- Info Details -->
                <div class="p-4 sm:p-5 flex flex-col gap-4">
                    <div>
                        <h2 class="font-['Playfair_Display'] font-bold text-lg sm:text-xl text-[#3B1A2B]">
                            {{ $loc->name }}
                        </h2>
                        
                        <p class="text-xs text-[#8A6477] mt-1.5 flex items-start gap-1.5 leading-relaxed">
                            <svg class="w-4 h-4 text-[#E6107A] flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5 2.5 2.5 0 0 1 0 5z"/>
                            </svg>
                            <span>{{ $loc->address }}, {{ $loc->city }}</span>
                        </p>

                        @if($loc->phone)
                            <p class="text-xs text-[#3B1A2B] font-semibold mt-1 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-[#25D366] fill-current" viewBox="0 0 24 24">
                                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.392-10.416c-5.514 0-10 4.486-10 10 0 1.764.459 3.421 1.261 4.869l-1.341 4.903 5.02-1.316c1.397.763 2.99 1.199 4.685 1.199 5.514 0 10-4.486 10-10s-4.486-10-10-10z"/>
                                </svg>
                                <span>WhatsApp / Telepon: {{ $loc->phone }}</span>
                            </p>
                        @endif
                    </div>

                    <!-- Direct Action Buttons -->
                    <div class="grid grid-cols-2 gap-2.5">
                        <a href="{{ $loc->maps_url ?? 'https://maps.google.com/?q=Putri+Beauty+Care+Banda+Aceh' }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-full bg-[#E6107A] hover:bg-[#C2095F] text-white text-xs font-bold shadow-xs transition-colors">
                            <svg class="w-4 h-4 fill-none stroke-currentColor stroke-2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/>
                                <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/>
                            </svg>
                            <span>Buka Google Maps</span>
                        </a>

                        <a href="https://wa.me/{{ \App\Services\WhatsAppLink::cleanPhoneNumber($loc->phone ?? setting('contact.whatsapp_main', '6281362673728')) }}?text={{ rawurlencode('Halo admin, saya ingin tanya rute dan lokasi salon Putri Beauty Care.') }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-full bg-[#25D366] hover:bg-[#20bd5a] text-white text-xs font-bold shadow-xs transition-colors">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.392-10.416c-5.514 0-10 4.486-10 10 0 1.764.459 3.421 1.261 4.869l-1.341 4.903 5.02-1.316c1.397.763 2.99 1.199 4.685 1.199 5.514 0 10-4.486 10-10s-4.486-10-10-10z"/>
                            </svg>
                            <span>Chat Cabang</span>
                        </a>
                    </div>

                    <!-- Weekly Operating Hours Schedule -->
                    <div class="bg-[#FFF9FB] p-3.5 rounded-2xl border border-pink-100">
                        <h4 class="font-bold text-xs text-[#C2095F] uppercase tracking-wider mb-2 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                            <span>Jadwal Operasional Lengkap:</span>
                        </h4>
                        
                        <div class="divide-y divide-pink-100/60 text-xs">
                            @foreach($loc->operatingHours as $schedule)
                                <div class="py-1 flex items-center justify-between">
                                    <span class="font-medium text-[#3B1A2B]">{{ $schedule->day_name }}</span>
                                    <span class="font-semibold {{ $schedule->is_closed ? 'text-gray-400' : 'text-[#C2095F]' }}">
                                        {{ $schedule->formatted_hours }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Google Maps Lazy Loaded Iframe Embed -->
                    <div class="rounded-2xl overflow-hidden border border-pink-100 aspect-video w-full bg-gray-100">
                        @if($loc->maps_embed_url)
                            <iframe src="{{ $loc->maps_embed_url }}" 
                                    width="100%" 
                                    height="100%" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        @else
                            <iframe src="https://maps.google.com/maps?q={{ urlencode($loc->address . ' ' . $loc->city) }}&t=&z=15&ie=UTF8&iwloc=&output=embed"
                                    width="100%" 
                                    height="100%" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy">
                            </iframe>
                        @endif
                    </div>

                </div>

            </div>
        @endforeach

    </div>

</div>
@endsection
