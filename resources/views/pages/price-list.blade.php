@extends('layouts.app')

@section('content')
<div class="w-full flex flex-col bg-[#FFF5F9] min-h-screen">

    <!-- Top Navigation Header (Hidden on Print) -->
    <div class="no-print sticky top-0 z-30 bg-white/95 backdrop-blur-md border-b border-[#FFE4EF] px-4 py-3 flex items-center justify-between shadow-xs">
        <a href="{{ route('home') }}" class="flex items-center gap-1.5 text-[#C2095F] hover:text-[#E6107A] font-semibold text-xs tracking-tight transition-colors">
            <svg class="w-4 h-4 fill-none stroke-currentColor stroke-2" viewBox="0 0 24 24">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            <span>Beranda</span>
        </a>

        <h1 class="font-['Playfair_Display'] text-base sm:text-lg font-bold text-[#C2095F] tracking-wide">
            Daftar Harga Treatment
        </h1>

        <!-- Print Action Button -->
        <button onclick="window.print()" class="inline-flex items-center gap-1.5 px-3 py-1 bg-white border border-[#C9A24B] text-[#C9A24B] hover:bg-[#FFF7FA] rounded-full text-xs font-semibold shadow-2xs transition-all">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="6 9 6 2 18 2 18 9"/>
                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
                <rect x="6" y="14" width="12" height="8"/>
            </svg>
            <span class="hidden sm:inline">Cetak</span>
        </button>
    </div>

    <!-- Print Only Header -->
    <div class="hidden print:block text-center p-6 border-b border-gray-200">
        <h1 class="font-['Great_Vibes'] text-4xl text-[#C2095F]">{{ setting('general.brand_name', 'Putri Beauty Care') }}</h1>
        <p class="text-xs text-gray-600 mt-1">{{ setting('general.tagline', 'Salon, Aesthetic & Skincare Banda Aceh') }}</p>
        <p class="text-[10px] text-gray-500">WhatsApp Booking: {{ setting('contact.whatsapp_main', '081362673728') }} · Alamat: Jl. Sultan Iskandar Muda, Banda Aceh</p>
    </div>

    <!-- Content Body -->
    <div class="p-4 sm:p-5 flex flex-col gap-5">

        <!-- Intro Banner (Hidden on Print) -->
        <div class="no-print bg-gradient-to-r from-[#FFF0F6] to-white p-4 rounded-2xl gold-border shadow-xs flex items-center justify-between">
            <div>
                <h2 class="font-bold text-sm text-[#C2095F]">Price List Resmi Putri Beauty Care</h2>
                <p class="text-[11px] text-[#8A6477] mt-0.5">
                    Seluruh harga tertera transparan, tanpa biaya tersembunyi.
                </p>
            </div>
            <div class="text-2xl">
                ✨
            </div>
        </div>

        <!-- Grouped Price Tables -->
        @foreach($categories as $category)
            @if($category->activeItems->isNotEmpty())
                <div class="bg-white rounded-2xl gold-border overflow-hidden shadow-xs">
                    
                    <!-- Category Header -->
                    <div class="bg-gradient-to-r from-[#FFF0F6] via-white to-[#FFF0F6] px-4 py-2.5 border-b border-pink-100 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="text-base text-[#C2095F]">
                                @if($category->icon === 'scissors') ✂️
                                @elseif($category->icon === 'heart') 💆‍♀️
                                @elseif($category->icon === 'shopping-bag') 🛍️
                                @else ✨
                                @endif
                            </span>
                            <h3 class="font-bold text-sm text-[#3B1A2B] uppercase tracking-wide">
                                {{ $category->name }}
                            </h3>
                        </div>
                        <span class="text-[10px] text-[#8A6477] font-medium bg-pink-50 px-2 py-0.5 rounded-full">
                            {{ $category->activeItems->count() }} Pilihan
                        </span>
                    </div>

                    <!-- Items Rows -->
                    <div class="divide-y divide-pink-50">
                        @foreach($category->activeItems as $item)
                            <div class="p-3 sm:p-3.5 flex items-center justify-between gap-3 hover:bg-rose-50/20 transition-colors">
                                
                                <!-- Left Info -->
                                <div class="flex flex-col flex-1 min-w-0">
                                    <div class="flex items-center gap-1.5 flex-wrap">
                                        <a href="{{ route('catalog.show', ['category' => $category->slug, 'item' => $item->slug]) }}" 
                                           class="font-semibold text-xs sm:text-sm text-[#3B1A2B] hover:text-[#E6107A] transition-colors line-clamp-1">
                                            {{ $item->name }}
                                        </a>

                                        @if($item->badge)
                                            <span class="bg-[#FFE4EF] text-[#C2095F] text-[9px] font-bold px-1.5 py-0.2 rounded-md">
                                                {{ $item->badge }}
                                            </span>
                                        @endif
                                    </div>

                                    @if($item->short_description)
                                        <p class="text-[10px] sm:text-[11px] text-[#8A6477] line-clamp-1 mt-0.5">
                                            {{ $item->short_description }}
                                        </p>
                                    @endif

                                    @if($item->duration_minutes)
                                        <span class="text-[9px] text-[#8A6477] font-medium mt-0.5">
                                            Durasi: ±{{ $item->duration_minutes }} menit
                                        </span>
                                    @endif
                                </div>

                                <!-- Right Price & Booking Button -->
                                <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0">
                                    <div class="flex flex-col items-end text-right">
                                        <span class="font-bold text-xs sm:text-sm text-[#C2095F]">
                                            {{ $item->formatted_price }}
                                        </span>
                                        @if($item->compare_price)
                                            <span class="text-[10px] text-gray-400 line-through">
                                                {{ format_rupiah($item->compare_price) }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Quick Booking Button (Hidden on Print) -->
                                    @php
                                        $waBookingLink = \App\Services\WhatsAppLink::build('booking', [
                                            'nama' => 'Pelanggan',
                                            'layanan' => $item->name,
                                            'tanggal' => date('d-m-Y'),
                                            'jam' => 'Jadwal terdekat',
                                            'catatan' => 'Booking langsung dari daftar harga'
                                        ]);
                                    @endphp
                                    <a href="{{ $waBookingLink }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="no-print p-1.5 sm:px-2.5 sm:py-1 rounded-full bg-[#25D366] hover:bg-[#20bd5a] text-white text-[10px] sm:text-xs font-bold shadow-2xs hover:shadow transition-all flex items-center gap-1">
                                        <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24">
                                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.392-10.416c-5.514 0-10 4.486-10 10 0 1.764.459 3.421 1.261 4.869l-1.341 4.903 5.02-1.316c1.397.763 2.99 1.199 4.685 1.199 5.514 0 10-4.486 10-10s-4.486-10-10-10z"/>
                                        </svg>
                                        <span class="hidden sm:inline">Booking</span>
                                    </a>
                                </div>

                            </div>
                        @endforeach
                    </div>

                </div>
            @endif
        @endforeach

        <!-- Last Updated Notice -->
        <div class="text-center py-4 border-t border-pink-100">
            <p class="text-[11px] text-[#8A6477]">
                📅 Terakhir diperbarui: 
                <span class="font-semibold text-[#3B1A2B]">
                    {{ $lastUpdated ? \Carbon\Carbon::parse($lastUpdated)->isoFormat('D MMMM Y') : date('d F Y') }}
                </span>
            </p>
            <p class="text-[10px] text-[#8A6477] mt-0.5">
                Harga dapat berubah sewaktu-waktu sesuai penyesuaian layanan resmi salon.
            </p>
        </div>

    </div>

</div>
@endsection
