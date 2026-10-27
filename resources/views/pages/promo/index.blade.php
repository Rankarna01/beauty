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

    <!-- Content Body -->
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
                <div class="bg-white rounded-3xl gold-border overflow-hidden shadow-sm hover:shadow-md transition-all duration-200 flex flex-col">
                    
                    <!-- Promo Banner -->
                    <div class="relative w-full aspect-video bg-pink-100 overflow-hidden">
                        @php
                            $bannerImg = $promo->banner_path 
                                ? asset('storage/' . $promo->banner_path)
                                : 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80';
                        @endphp
                        <img src="{{ $bannerImg }}" alt="{{ $promo->title }}" class="w-full h-full object-cover">
                        
                        <!-- Floating Countdown Badge -->
                        <div class="absolute top-3 right-3 bg-gradient-to-r from-[#FF1A8C] to-[#C2095F] text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-md border border-white/40">
                            ⏳ Berakhir dalam {{ $promo->days_remaining }} hari
                        </div>
                    </div>

                    <!-- Promo Content -->
                    <div class="p-4 sm:p-5 flex flex-col gap-2.5">
                        <div class="text-[10px] text-[#8A6477] font-semibold uppercase tracking-wider">
                            Periode: {{ $promo->starts_at->isoFormat('D MMMM') }} - {{ $promo->ends_at->isoFormat('D MMMM Y') }}
                        </div>

                        <h2 class="font-['Playfair_Display'] font-bold text-base sm:text-lg text-[#3B1A2B] leading-snug">
                            <a href="{{ route('promo.show', $promo->slug) }}" class="hover:text-[#E6107A] transition-colors">
                                {{ $promo->title }}
                            </a>
                        </h2>

                        @if($promo->summary)
                            <p class="text-xs text-[#8A6477] line-clamp-2 leading-relaxed">
                                {{ $promo->summary }}
                            </p>
                        @endif

                        <!-- Action Buttons -->
                        <div class="pt-3 border-t border-pink-50 flex items-center gap-2">
                            <a href="{{ route('promo.show', $promo->slug) }}" 
                               class="flex-1 text-center py-2 px-3 rounded-full border border-[#C2095F] text-[#C2095F] hover:bg-pink-50 text-xs font-semibold transition-colors">
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
                               class="flex-1 flex items-center justify-center gap-1.5 py-2 px-3 rounded-full bg-[#25D366] hover:bg-[#20bd5a] text-white text-xs font-bold shadow-xs transition-all">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.392-10.416c-5.514 0-10 4.486-10 10 0 1.764.459 3.421 1.261 4.869l-1.341 4.903 5.02-1.316c1.397.763 2.99 1.199 4.685 1.199 5.514 0 10-4.486 10-10s-4.486-10-10-10z"/>
                                </svg>
                                <span>Klaim Promo</span>
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach
        @endif

    </div>

</div>
@endsection
