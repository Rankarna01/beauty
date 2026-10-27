<div class="w-full flex flex-col bg-[#FFF5F9] min-h-screen">

    <!-- Top Navigation Header -->
    <div class="sticky top-0 z-30 bg-white/95 backdrop-blur-md border-b border-[#FFE4EF] px-4 py-3 shadow-xs">
        <div class="flex items-center justify-between gap-3">
            <a href="{{ route('home') }}" class="flex items-center gap-1.5 text-[#C2095F] hover:text-[#E6107A] font-semibold text-xs tracking-tight transition-colors">
                <svg class="w-4 h-4 fill-none stroke-currentColor stroke-2" viewBox="0 0 24 24">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                <span>Beranda</span>
            </a>
            
            <h1 class="font-['Playfair_Display'] text-base sm:text-lg font-bold text-[#C2095F] tracking-wide">
                Katalog Perawatan & Produk
            </h1>

            <a href="https://wa.me/{{ \App\Services\WhatsAppLink::cleanPhoneNumber(setting('contact.whatsapp_main', '6281362673728')) }}" 
               target="_blank" 
               class="text-emerald-600 hover:text-emerald-700">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.392-10.416c-5.514 0-10 4.486-10 10 0 1.764.459 3.421 1.261 4.869l-1.341 4.903 5.02-1.316c1.397.763 2.99 1.199 4.685 1.199 5.514 0 10-4.486 10-10s-4.486-10-10-10z"/>
                </svg>
            </a>
        </div>

        <!-- Search Bar with Instant Debounce -->
        <div class="mt-3 relative">
            <input type="text"
                   wire:model.live.debounce.300ms="search"
                   placeholder="Cari perawatan (mis. Facial, Creambath, Nail Art)..."
                   class="w-full pl-9 pr-8 py-2 bg-[#FFF0F6]/80 focus:bg-white text-xs sm:text-sm rounded-full border border-[#E5C07B]/60 focus:border-[#C2095F] focus:outline-none focus:ring-1 focus:ring-[#C2095F] transition-all">
            <svg class="w-4 h-4 text-[#8A6477] absolute left-3 top-2.5 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            @if($search)
                <button wire:click="$set('search', '')" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            @endif
        </div>

        <!-- Category Filter Tabs with FontAwesome Icons -->
        <div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar pt-2.5 pb-1">
            <button wire:click="selectCategory('')"
                    class="px-3.5 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-all flex items-center gap-1.5 {{ empty($categorySlug) ? 'bg-[#E6107A] text-white shadow-xs' : 'bg-white text-[#8A6477] border border-pink-200 hover:border-[#E6107A]' }}">
                <i class="fa-solid fa-layer-group text-[11px]"></i>
                <span>Semua</span>
            </button>
            @foreach($categories as $category)
                <button wire:click="selectCategory('{{ $category->slug }}')"
                        class="px-3.5 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-all flex items-center gap-1.5 {{ $categorySlug === $category->slug ? 'bg-[#E6107A] text-white shadow-xs' : 'bg-white text-[#8A6477] border border-pink-200 hover:border-[#E6107A]' }}">
                    <i class="{{ $category->icon ?: 'fa-solid fa-tag' }} text-[11px]"></i>
                    <span>{{ $category->name }}</span>
                    <span class="text-[10px] opacity-80">({{ $category->active_items_count }})</span>
                </button>
            @endforeach
        </div>
    </div>

    <!-- Catalog Items Grid -->
    <div class="p-3 sm:p-4">
        @if($items->isEmpty())
            <div class="w-full py-16 flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 rounded-full bg-pink-100 flex items-center justify-center text-pink-400 mb-3">
                    <i class="fa-solid fa-magnifying-glass text-2xl"></i>
                </div>
                <h3 class="font-bold text-sm text-[#3B1A2B]">Tidak Ada Item Ditemukan</h3>
                <p class="text-xs text-[#8A6477] mt-1 max-w-xs">
                    Coba ubah kata kunci pencarian atau pilih kategori lain di atas.
                </p>
                <button wire:click="$set('search', ''); $set('categorySlug', '')" class="mt-4 px-4 py-1.5 rounded-full bg-[#E6107A] text-white text-xs font-semibold hover:bg-[#C2095F]">
                    Reset Filter
                </button>
            </div>
        @else
            <div class="grid grid-cols-2 gap-3 sm:gap-4">
                @foreach($items as $item)
                    @php
                        $isNailArt = $item->category?->slug === 'nail-art' || str_contains($item->slug, 'nail');
                    @endphp
                    <div class="bg-white rounded-2xl gold-border overflow-hidden flex flex-col shadow-xs hover:shadow-md transition-all duration-200 group">
                        
                        <!-- Image Container (Compact aspect-ratio for Nail Art, Aspect 4:5 for other services) -->
                        <div class="relative w-full {{ $isNailArt ? 'aspect-[4/3] max-h-36' : 'aspect-[4/5]' }} bg-pink-50 overflow-hidden cursor-pointer" wire:click="openDetail({{ $item->id }})">
                            <img src="{{ $item->primary_image_url }}" 
                                 alt="{{ $item->name }}"
                                 loading="lazy"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">

                            <!-- Badge Overlay -->
                            @if($item->badge)
                                <div class="absolute top-2 right-2 z-10 bg-gradient-to-r from-[#FF1A8C] to-[#C2095F] text-white text-[9px] font-bold px-2 py-0.5 rounded-full shadow-xs border border-white/40">
                                    {{ $item->badge }}
                                </div>
                            @elseif($item->is_featured)
                                <div class="absolute top-2 right-2 z-10 bg-[#C9A24B] text-white text-[9px] font-bold px-2 py-0.5 rounded-full shadow-xs">
                                    <i class="fa-solid fa-star text-[8px] mr-0.5"></i> Unggulan
                                </div>
                            @endif

                            <!-- Duration Badge -->
                            @if($item->duration_minutes && !$isNailArt)
                                <div class="absolute top-2 left-2 z-10 bg-black/50 backdrop-blur-xs text-white text-[9px] font-medium px-1.5 py-0.5 rounded-md flex items-center gap-1">
                                    <i class="fa-regular fa-clock text-[9px]"></i>
                                    <span>{{ $item->duration_minutes }} mnt</span>
                                </div>
                            @endif

                            <!-- Quick View Hint -->
                            <div class="absolute inset-x-0 bottom-0 py-1 bg-gradient-to-t from-black/60 to-transparent text-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="text-white text-[10px] font-semibold tracking-wide">Lihat Detail</span>
                            </div>
                        </div>

                        <!-- Content Details -->
                        <div class="p-2.5 sm:p-3 flex flex-col flex-1 justify-between">
                            <div>
                                <span class="text-[9px] sm:text-[10px] font-medium text-[#8A6477] uppercase tracking-wider block mb-0.5">
                                    {{ $item->category?->name }}
                                </span>
                                
                                <h3 wire:click="openDetail({{ $item->id }})" class="font-bold text-xs sm:text-sm text-[#3B1A2B] hover:text-[#E6107A] transition-colors line-clamp-2 leading-snug cursor-pointer">
                                    {{ $item->name }}
                                </h3>

                                @if($item->short_description && !$isNailArt)
                                    <p class="text-[10px] sm:text-[11px] text-[#8A6477] line-clamp-2 mt-1 leading-tight">
                                        {{ $item->short_description }}
                                    </p>
                                @endif
                            </div>

                            <!-- Price & CTA Button -->
                            <div class="mt-2.5 pt-2 border-t border-pink-50">
                                <div class="flex items-baseline gap-1.5 flex-wrap">
                                    <span class="font-bold text-xs sm:text-sm text-[#C2095F]">
                                        {{ $item->formatted_price }}
                                    </span>
                                    @if($item->compare_price)
                                        <span class="text-[10px] text-gray-400 line-through">
                                            {{ format_rupiah($item->compare_price) }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Action Button: WhatsApp Direct with FontAwesome -->
                                @php
                                    $waLink = $this->getWhatsAppUrl($item);
                                    $ctaText = $item->type === 'service' ? 'Booking WA' : 'Pesan WA';
                                @endphp
                                <a href="{{ $waLink }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   wire:click="logWhatsAppClick({{ $item->id }})"
                                   class="mt-2 w-full flex items-center justify-center gap-1.5 py-1.5 px-2 bg-gradient-to-r from-[#25D366] to-[#128C7E] hover:from-[#20bd5a] hover:to-[#0f7a6d] text-white rounded-full text-[11px] font-bold shadow-xs hover:shadow transition-all group-hover:scale-[1.02]">
                                    <i class="fa-brands fa-whatsapp text-xs"></i>
                                    <span>{{ $ctaText }}</span>
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>


    <!-- ========================================================================= -->
    <!-- SLIDE-OVER / MODAL DETAIL ITEM                                            -->
    <!-- ========================================================================= -->
    @if($selectedItem)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-black/60 backdrop-blur-xs flex items-end sm:items-center justify-center p-0 sm:p-4 animate-fade-in"
             wire:click.self="closeDetail">
            
            <div class="w-full sm:max-w-md bg-white rounded-t-3xl sm:rounded-3xl overflow-hidden shadow-2xl border border-pink-100 flex flex-col max-h-[90vh]">
                
                <!-- Modal Header Image -->
                <div class="relative w-full aspect-video bg-pink-100">
                    <img src="{{ $selectedItem->primary_image_url }}" alt="{{ $selectedItem->name }}" class="w-full h-full object-cover">
                    
                    <button wire:click="closeDetail" class="absolute top-3 right-3 w-8 h-8 rounded-full bg-black/50 hover:bg-black/70 text-white flex items-center justify-center transition-colors">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>

                    @if($selectedItem->badge)
                        <div class="absolute bottom-3 left-3 bg-[#E6107A] text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-xs">
                            {{ $selectedItem->badge }}
                        </div>
                    @endif
                </div>

                <!-- Modal Body -->
                <div class="p-5 overflow-y-auto space-y-4">
                    <div>
                        <span class="text-xs text-[#8A6477] font-semibold uppercase tracking-wider">
                            {{ $selectedItem->category->name }}
                        </span>
                        <h2 class="font-['Playfair_Display'] text-xl font-bold text-[#3B1A2B] mt-0.5">
                            {{ $selectedItem->name }}
                        </h2>
                        
                        <div class="flex items-center gap-3 mt-2">
                            <span class="font-bold text-lg text-[#C2095F]">
                                {{ $selectedItem->formatted_price }}
                            </span>
                            @if($selectedItem->compare_price)
                                <span class="text-xs text-gray-400 line-through">
                                    {{ format_rupiah($selectedItem->compare_price) }}
                                </span>
                            @endif

                            @if($selectedItem->duration_minutes)
                                <span class="ml-auto inline-flex items-center gap-1 text-xs text-[#8A6477] bg-pink-50 px-2.5 py-1 rounded-full font-medium">
                                    ⏱️ {{ $selectedItem->duration_minutes }} Menit
                                </span>
                            @endif
                        </div>
                    </div>

                    @if($selectedItem->description)
                        <div class="prose prose-sm text-xs text-[#3B1A2B] leading-relaxed border-t border-pink-50 pt-3">
                            {!! $selectedItem->description !!}
                        </div>
                    @endif

                    <!-- Benefits Checklist -->
                    @if(!empty($selectedItem->benefits) && is_array($selectedItem->benefits))
                        <div class="border-t border-pink-50 pt-3">
                            <h4 class="font-bold text-xs text-[#C2095F] uppercase tracking-wide mb-2">
                                ✨ Manfaat & Keunggulan:
                            </h4>
                            <ul class="space-y-1.5">
                                @foreach($selectedItem->benefits as $benefit)
                                    <li class="flex items-start gap-2 text-xs text-[#3B1A2B]">
                                        <svg class="w-4 h-4 text-[#C9A24B] flex-shrink-0 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>{{ $benefit }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- Modal Footer CTA -->
                <div class="p-4 bg-gray-50 border-t border-gray-100 flex items-center gap-2">
                    <button wire:click="closeDetail" class="px-4 py-2.5 rounded-full border border-gray-300 text-xs font-semibold text-gray-700 hover:bg-gray-100">
                        Tutup
                    </button>
                    
                    @php
                        $waModalUrl = $this->getWhatsAppUrl($selectedItem);
                        $modalCtaText = $selectedItem->type === 'service' ? 'Booking via WhatsApp' : 'Beli via WhatsApp';
                    @endphp
                    <a href="{{ $waModalUrl }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       wire:click="logWhatsAppClick({{ $selectedItem->id }})"
                       class="flex-1 flex items-center justify-center gap-2 py-2.5 px-4 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-full text-xs font-bold shadow-md transition-all">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                        <span>{{ $modalCtaText }}</span>
                    </a>
                </div>

            </div>
        </div>
    @endif

</div>
