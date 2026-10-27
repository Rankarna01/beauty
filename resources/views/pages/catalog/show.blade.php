@extends('layouts.app')

@section('content')
<div class="w-full flex flex-col bg-[#FFF5F9] min-h-screen">

    <!-- Top Navigation Header -->
    <div class="sticky top-0 z-30 bg-white/95 backdrop-blur-md border-b border-[#FFE4EF] px-4 py-3 flex items-center justify-between shadow-xs">
        <a href="{{ route('catalog.category', $category->slug) }}" class="flex items-center gap-1.5 text-[#C2095F] hover:text-[#E6107A] font-semibold text-xs tracking-tight transition-colors">
            <svg class="w-4 h-4 fill-none stroke-currentColor stroke-2" viewBox="0 0 24 24">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            <span>{{ $category->name }}</span>
        </a>

        <div class="flex items-center gap-2">
            <a href="{{ route('home') }}" class="text-[#8A6477] hover:text-[#C2095F] text-xs font-semibold">
                Beranda
            </a>
        </div>
    </div>

    <!-- Main Hero Image -->
    <div class="relative w-full aspect-square sm:aspect-video bg-pink-100 overflow-hidden">
        @php
            $itemImg = $item->primary_image 
                ? asset('storage/' . $item->primary_image)
                : 'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80';
        @endphp
        <img src="{{ $itemImg }}" alt="{{ $item->name }}" class="w-full h-full object-cover">

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
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.392-10.416c-5.514 0-10 4.486-10 10 0 1.764.459 3.421 1.261 4.869l-1.341 4.903 5.02-1.316c1.397.763 2.99 1.199 4.685 1.199 5.514 0 10-4.486 10-10s-4.486-10-10-10z"/>
                </svg>
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
