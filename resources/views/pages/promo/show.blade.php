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

    <!-- Promo Status Card (No Photos, Clean Text & Badges) -->
    <div class="px-5 pt-4">
        <div class="w-full bg-white border border-[#E5C578] rounded-3xl p-4 sm:p-5 flex items-center justify-between gap-3 shadow-xs">
            <div class="flex items-center gap-2">
                <span class="w-9 h-9 rounded-full bg-pink-100 text-[#C2095F] flex items-center justify-center font-bold text-sm">
                    👑
                </span>
                <div class="flex flex-col">
                    <span class="text-[10px] text-[#8A6477] font-semibold uppercase tracking-wider">
                        Periode: {{ $promo->starts_at->isoFormat('D MMMM') }} - {{ $promo->ends_at->isoFormat('D MMMM Y') }}
                    </span>
                    <span class="text-xs font-bold text-[#3B1A2B]">
                        {{ $isExpired ? 'Promo Telah Berakhir' : 'Promo Aktif Bulan Ini' }}
                    </span>
                </div>
            </div>

            @if($isExpired)
                <span class="bg-red-100 text-red-600 text-[10px] font-bold px-3 py-1 rounded-full border border-red-200">
                    Expired
                </span>
            @else
                <span class="bg-gradient-to-r from-[#FF1A8C] to-[#C2095F] text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-xs border border-white/40">
                    ⏳ Sisa {{ $promo->days_remaining }} hari
                </span>
            @endif
        </div>
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
                    <i class="fa-brands fa-whatsapp text-lg"></i>
                    <span>Klaim Promo Ini via WhatsApp</span>
                </a>
            </div>
        @endif

    </div>

</div>
@endsection
