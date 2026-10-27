@extends('layouts.app')

@section('content')
<div class="w-full flex flex-col bg-[#FFF5F9] min-h-screen">

    <!-- Top Navigation Header -->
    <div class="sticky top-0 z-30 bg-white/95 backdrop-blur-md border-b border-[#FFE4EF] px-4 py-3 flex items-center justify-between shadow-xs">
        <a href="{{ route('catalog.category', $category->slug) }}" class="flex items-center gap-1.5 text-[#C2095F] hover:text-[#E6107A] font-semibold text-xs tracking-tight transition-colors">
            <i class="fa-solid fa-arrow-left text-xs"></i>
            <span>{{ $category->name }}</span>
        </a>

        <div class="flex items-center gap-2">
            <a href="{{ route('home') }}" class="text-[#8A6477] hover:text-[#C2095F] text-xs font-semibold flex items-center gap-1">
                <i class="fa-solid fa-house text-xs"></i>
                <span>Beranda</span>
            </a>
        </div>
    </div>

    <!-- Main Hero Image -->
    @php
        $isNailShow = $category->slug === 'nail-art' || str_contains($item->slug, 'nail');
    @endphp
    <div class="relative w-full {{ $isNailShow ? 'aspect-[4/3] max-h-72' : 'aspect-square sm:aspect-video' }} bg-pink-100 overflow-hidden">
        <img src="{{ $item->primary_image_url }}" alt="{{ $item->name }}" class="w-full h-full object-cover">

        @if($item->badge)
            <div class="absolute top-4 right-4 bg-gradient-to-r from-[#FF1A8C] to-[#C2095F] text-white text-xs font-bold px-3 py-1 rounded-full shadow-md border border-white/40">
                {{ $item->badge }}
            </div>
        @endif
    </div>

    <!-- Content Details -->
    <div class="p-5 flex flex-col gap-4">
        
        <div>
            <div class="flex items-center justify-between gap-2">
                <span class="text-xs font-semibold text-[#8A6477] uppercase tracking-wider">
                    {{ $category->name }}
                </span>
                @if($item->duration_minutes)
                    <span class="inline-flex items-center gap-1 text-xs text-[#8A6477] bg-pink-50 px-2.5 py-0.5 rounded-full font-medium">
                        ⏱️ {{ $item->duration_minutes }} Menit
                    </span>
                @endif
            </div>

            <h1 class="font-['Playfair_Display'] text-2xl font-bold text-[#3B1A2B] mt-1 leading-snug">
                {{ $item->name }}
            </h1>

            <div class="flex items-baseline gap-2 mt-2">
                <span class="font-bold text-xl text-[#C2095F]">
                    {{ $item->formatted_price }}
                </span>
                @if($item->compare_price)
                    <span class="text-sm text-gray-400 line-through">
                        {{ format_rupiah($item->compare_price) }}
                    </span>
                @endif
            </div>
        </div>

        @if($item->short_description)
            <div class="bg-white p-3.5 rounded-2xl gold-border text-xs text-[#3B1A2B] leading-relaxed">
                {{ $item->short_description }}
            </div>
        @endif

        <!-- Benefits List -->
        @if(!empty($item->benefits) && is_array($item->benefits))
            <div class="bg-white p-4 rounded-2xl gold-border">
                <h3 class="font-bold text-xs text-[#C2095F] uppercase tracking-wider mb-2.5 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-[#C9A24B]" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <span>Khasiat & Manfaat Perawatan:</span>
                </h3>
                <ul class="space-y-2">
                    @foreach($item->benefits as $benefit)
                        <li class="flex items-start gap-2.5 text-xs text-[#3B1A2B]">
                            <svg class="w-4 h-4 text-[#C9A24B] flex-shrink-0 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ $benefit }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($item->description)
            <div class="bg-white p-4 rounded-2xl gold-border">
                <h3 class="font-bold text-xs text-[#C2095F] uppercase tracking-wider mb-2">
                    Detail & Prosedur:
                </h3>
                <div class="prose prose-sm text-xs text-[#3B1A2B] leading-relaxed">
                    {!! $item->description !!}
                </div>
            </div>
        @endif

        <!-- Direct WhatsApp CTA Button -->
        <div class="pt-2">
            @php
                $btnText = $item->type === 'service' ? 'Booking Treatment via WhatsApp' : 'Pesan Skincare via WhatsApp';
            @endphp
            <a href="{{ $waUrl }}"
               target="_blank"
               rel="noopener noreferrer"
               class="w-full flex items-center justify-center gap-2 py-3 px-5 bg-gradient-to-r from-[#25D366] to-[#128C7E] hover:from-[#20bd5a] hover:to-[#0f7a6d] text-white rounded-full text-sm font-bold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                <i class="fa-brands fa-whatsapp text-lg"></i>
                <span>{{ $btnText }}</span>
            </a>
        </div>

        <!-- Related Items -->
        @if($relatedItems->isNotEmpty())
            <div class="mt-6 pt-5 border-t border-pink-100">
                <h3 class="font-['Playfair_Display'] font-bold text-sm text-[#3B1A2B] mb-3">
                    Layanan Terkait Lainnya:
                </h3>
                <div class="grid grid-cols-2 gap-3">
                    @foreach($relatedItems as $related)
                        <a href="{{ route('catalog.show', ['category' => $category->slug, 'item' => $related->slug]) }}"
                           class="bg-white p-2.5 rounded-xl gold-border hover:shadow-md transition-all flex flex-col justify-between">
                            <span class="font-bold text-xs text-[#3B1A2B] line-clamp-1">
                                {{ $related->name }}
                            </span>
                            <span class="text-xs font-semibold text-[#C2095F] mt-1">
                                {{ $related->formatted_price }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

</div>
@endsection
