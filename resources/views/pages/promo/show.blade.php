@extends('layouts.app')

@section('content')
<div class="w-full flex flex-col bg-[#FFF5F9] min-h-screen">

    <!-- Top Navigation Header -->
    <div class="sticky top-0 z-30 bg-white/95 backdrop-blur-md border-b border-[#FFE4EF] px-4 py-3 flex items-center justify-between shadow-xs">
        <a href="{{ route('promo.index') }}" class="flex items-center gap-1.5 text-[#C2095F] hover:text-[#E6107A] font-semibold text-xs tracking-tight transition-colors">
            <svg class="w-4 h-4 fill-none stroke-currentColor stroke-2" viewBox="0 0 24 24">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            <span>Daftar Promo</span>
        </a>

        <a href="{{ route('home') }}" class="text-[#8A6477] hover:text-[#C2095F] text-xs font-semibold">
            Beranda
        </a>
    </div>

    <!-- Promo Banner Image -->
    <div class="relative w-full aspect-video bg-pink-100 overflow-hidden">
        @php
            $bannerImg = $promo->banner_path 
                ? asset('storage/' . $promo->banner_path)
                : 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80';
        @endphp
        <img src="{{ $bannerImg }}" alt="{{ $promo->title }}" class="w-full h-full object-cover">

        @if($isExpired)
            <div class="absolute inset-0 bg-black/60 backdrop-blur-xs flex items-center justify-center">
                <span class="bg-red-600 text-white text-xs font-bold px-4 py-1 rounded-full shadow-md">
                    Promo Telah Berakhir
                </span>
            </div>
        @else
            <div class="absolute top-4 right-4 bg-gradient-to-r from-[#FF1A8C] to-[#C2095F] text-white text-xs font-bold px-3 py-1 rounded-full shadow-md border border-white/40">
                ⏳ Berakhir dalam {{ $promo->days_remaining }} hari
            </div>
        @endif
    </div>

    <!-- Content Details -->
    <div class="p-5 flex flex-col gap-4">

        <div>
            <div class="text-xs font-semibold text-[#8A6477] uppercase tracking-wider">
                Periode Promo: {{ $promo->starts_at->isoFormat('D MMMM') }} - {{ $promo->ends_at->isoFormat('D MMMM Y') }}
            </div>

            <h1 class="font-['Playfair_Display'] text-xl sm:text-2xl font-bold text-[#3B1A2B] mt-1 leading-snug">
                {{ $promo->title }}
            </h1>
        </div>

        @if($promo->summary)
            <div class="bg-white p-3.5 rounded-2xl gold-border text-xs text-[#3B1A2B] leading-relaxed">
                {{ $promo->summary }}
            </div>
        @endif

        <!-- Terms & Conditions (Rich Text) -->
        @if($promo->content)
            <div class="bg-white p-4 sm:p-5 rounded-2xl gold-border">
                <h3 class="font-bold text-xs text-[#C2095F] uppercase tracking-wider mb-2.5 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-[#C9A24B]" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <span>Syarat, Ketentuan & Prosedur Promo:</span>
                </h3>
                <div class="prose prose-sm text-xs text-[#3B1A2B] leading-relaxed">
                    {!! $promo->content !!}
                </div>
            </div>
        @endif

        <!-- Direct WhatsApp Claim CTA -->
        @if(! $isExpired)
            <div class="pt-2">
                <a href="{{ $waUrl }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="w-full flex items-center justify-center gap-2 py-3 px-5 bg-gradient-to-r from-[#25D366] to-[#128C7E] hover:from-[#20bd5a] hover:to-[#0f7a6d] text-white rounded-full text-sm font-bold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.392-10.416c-5.514 0-10 4.486-10 10 0 1.764.459 3.421 1.261 4.869l-1.341 4.903 5.02-1.316c1.397.763 2.99 1.199 4.685 1.199 5.514 0 10-4.486 10-10s-4.486-10-10-10z"/>
                    </svg>
                    <span>Klaim Promo Ini via WhatsApp</span>
                </a>
            </div>
        @endif

    </div>

</div>
@endsection
