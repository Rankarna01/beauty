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
            Booking Jadwal Salon
        </h1>

        <div class="w-12"></div>
    </div>

    <!-- Booking Form Container -->
    <div class="p-4 sm:p-5 flex flex-col gap-5">
        
        <!-- Header Callout -->
        <div class="bg-gradient-to-r from-[#FFF0F6] to-white p-4 rounded-2xl gold-border shadow-xs flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-[#E6107A] text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                <svg class="w-5 h-5 fill-none stroke-currentColor stroke-2" viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
            </div>
            <div>
                <h2 class="font-bold text-xs sm:text-sm text-[#3B1A2B]">Reservasi Perawatan Mudah</h2>
                <p class="text-[11px] text-[#8A6477] mt-0.5">
                    Pilih jadwal & perawatan favoritmu, pesan otomatis terformat langsung ke WhatsApp admin salon.
                </p>
            </div>
        </div>

        <form wire:submit.prevent="submit" class="space-y-4">
            
            <!-- 1. Nama Lengkap -->
            <div class="bg-white p-4 rounded-2xl gold-border shadow-2xs">
                <label for="name" class="block text-xs font-bold text-[#3B1A2B] uppercase tracking-wider mb-1.5">
                    1. Nama Lengkap <span class="text-rose-500">*</span>
                </label>
                <input type="text"
                       id="name"
                       wire:model.live.debounce.300ms="name"
                       placeholder="Masukkan nama lengkap Anda..."
                       class="w-full px-3.5 py-2.5 rounded-xl border border-pink-200 focus:border-[#C2095F] focus:ring-1 focus:ring-[#C2095F] text-xs sm:text-sm text-[#3B1A2B] bg-[#FFF9FB] focus:bg-white transition-all">
                @error('name')
                    <span class="text-[11px] text-rose-500 font-medium mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- 2. Pilihan Layanan (Multi-select) -->
            <div class="bg-white p-4 rounded-2xl gold-border shadow-2xs">
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-xs font-bold text-[#3B1A2B] uppercase tracking-wider">
                        2. Pilih Layanan Treatment <span class="text-rose-500">*</span>
                    </label>
                    <span class="text-[10px] text-[#C2095F] font-semibold bg-pink-50 px-2 py-0.5 rounded-full">
                        {{ count($selectedServices) }} Dipilih
                    </span>
                </div>

                @error('selectedServices')
                    <span class="text-[11px] text-rose-500 font-medium mb-2 block">{{ $message }}</span>
                @enderror

                <div class="space-y-3 max-h-64 overflow-y-auto pr-1">
                    @foreach($categories as $category)
                        <div class="pt-1">
                            <span class="text-[10px] font-bold text-[#8A6477] uppercase tracking-wider block mb-1.5">
                                {{ $category->name }}
                            </span>

                            <div class="grid grid-cols-1 gap-1.5">
                                @foreach($category->activeItems as $service)
                                    <label class="flex items-center justify-between p-2.5 rounded-xl border transition-all cursor-pointer {{ in_array($service->id, $selectedServices) ? 'bg-rose-50/70 border-[#E6107A] text-[#C2095F]' : 'bg-white border-pink-100 hover:border-pink-200 text-[#3B1A2B]' }}">
                                        <div class="flex items-center gap-2.5">
                                            <input type="checkbox"
                                                   wire:model.live="selectedServices"
                                                   value="{{ $service->id }}"
                                                   class="rounded text-[#E6107A] focus:ring-[#E6107A] border-pink-300">
                                            <div class="flex flex-col text-left">
                                                <span class="text-xs font-semibold leading-tight">
                                                    {{ $service->name }}
                                                </span>
                                                @if($service->duration_minutes)
                                                    <span class="text-[9px] text-[#8A6477]">
                                                        Durasi ±{{ $service->duration_minutes }} mnt
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <span class="text-xs font-bold text-[#C2095F] whitespace-nowrap ml-2">
                                            {{ $service->formatted_price }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- 3. Tanggal & Jam Kedatangan -->
            <div class="bg-white p-4 rounded-2xl gold-border shadow-2xs grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                
                <!-- Tanggal -->
                <div>
                    <label for="date" class="block text-xs font-bold text-[#3B1A2B] uppercase tracking-wider mb-1.5">
                        3. Tanggal Booking <span class="text-rose-500">*</span>
                    </label>
                    <input type="date"
                           id="date"
                           wire:model.live="date"
                           min="{{ date('Y-m-d') }}"
                           class="w-full px-3.5 py-2.5 rounded-xl border border-pink-200 focus:border-[#C2095F] focus:ring-1 focus:ring-[#C2095F] text-xs sm:text-sm text-[#3B1A2B] bg-[#FFF9FB] focus:bg-white transition-all">
                    <span class="text-[10px] text-[#8A6477] mt-1 block">
                        {{ $this->formatted_date }}
                    </span>
                    @error('date')
                        <span class="text-[11px] text-rose-500 font-medium mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Jam Kedatangan -->
                <div>
                    <label class="block text-xs font-bold text-[#3B1A2B] uppercase tracking-wider mb-1.5">
                        Jam Kedatangan <span class="text-rose-500">*</span>
                    </label>
                    
                    <div class="grid grid-cols-3 gap-1.5">
                        @foreach($timeSlots as $slot)
                            <button type="button"
                                    wire:click="$set('time', '{{ $slot }}')"
                                    class="py-1.5 px-2 rounded-lg text-xs font-semibold transition-all {{ $time === $slot ? 'bg-[#E6107A] text-white shadow-2xs' : 'bg-pink-50 text-[#8A6477] hover:bg-pink-100' }}">
                                {{ $slot }}
                            </button>
                        @endforeach
                    </div>
                    @error('time')
                        <span class="text-[11px] text-rose-500 font-medium mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <!-- 4. Catatan Tambahan (Opsional) -->
            <div class="bg-white p-4 rounded-2xl gold-border shadow-2xs">
                <label for="notes" class="block text-xs font-bold text-[#3B1A2B] uppercase tracking-wider mb-1.5">
                    4. Catatan Tambahan (Opsional)
                </label>
                <textarea id="notes"
                          wire:model.live.debounce.300ms="notes"
                          rows="2"
                          placeholder="Misal: Request terapis, keluhan jerawat, atau waktu khusus..."
                          class="w-full px-3.5 py-2 rounded-xl border border-pink-200 focus:border-[#C2095F] focus:ring-1 focus:ring-[#C2095F] text-xs sm:text-sm text-[#3B1A2B] bg-[#FFF9FB] focus:bg-white transition-all"></textarea>
            </div>

            <!-- ============================================================= -->
            <!-- LIVE WHATSAPP MESSAGE PREVIEW BUBBLE                          -->
            <!-- ============================================================= -->
            <div class="bg-white p-4 rounded-2xl gold-border shadow-xs">
                <div class="flex items-center gap-1.5 text-xs font-bold text-[#3B1A2B] uppercase tracking-wider mb-2">
                    <svg class="w-4 h-4 text-[#25D366] fill-current" viewBox="0 0 24 24">
                        <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.392-10.416c-5.514 0-10 4.486-10 10 0 1.764.459 3.421 1.261 4.869l-1.341 4.903 5.02-1.316c1.397.763 2.99 1.199 4.685 1.199 5.514 0 10-4.486 10-10s-4.486-10-10-10z"/>
                    </svg>
                    <span>Pratinjau Pesan WhatsApp Otomatis:</span>
                </div>

                <!-- WhatsApp Chat Bubble Simulation -->
                <div class="bg-[#EFEAE2] p-3 sm:p-4 rounded-xl border border-gray-200">
                    <div class="bg-[#DCF8C6] text-[#303030] p-3 rounded-lg rounded-tr-none shadow-xs text-xs font-mono whitespace-pre-wrap leading-relaxed max-w-sm ml-auto">
{{ $this->preview_message }}
                        <div class="text-[9px] text-gray-500 text-right mt-1.5 flex items-center justify-end gap-1">
                            <span>{{ date('H:i') }}</span>
                            <span class="text-blue-500 font-bold">✓✓</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                    class="w-full flex items-center justify-center gap-2 py-3.5 px-6 bg-gradient-to-r from-[#25D366] via-[#20bd5a] to-[#128C7E] hover:opacity-95 text-white rounded-full text-sm font-bold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5 cursor-pointer">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.392-10.416c-5.514 0-10 4.486-10 10 0 1.764.459 3.421 1.261 4.869l-1.341 4.903 5.02-1.316c1.397.763 2.99 1.199 4.685 1.199 5.514 0 10-4.486 10-10s-4.486-10-10-10z"/>
                </svg>
                <span>Lanjutkan & Kirim Booking ke WhatsApp</span>
            </button>

            <p class="text-[10px] text-center text-[#8A6477]">
                Tidak ada pembayaran online. Booking dikonfirmasi langsung oleh admin salon via chat WhatsApp.
            </p>

        </form>

    </div>

</div>
