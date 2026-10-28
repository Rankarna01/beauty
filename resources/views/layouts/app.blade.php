<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ setting('seo.meta_title', 'Putri Beauty Care – Salon, Aesthetic & Skincare Banda Aceh') }}</title>
    <meta name="description" content="{{ setting('seo.meta_description', 'Katalog resmi dan booking perawatan Putri Beauty Care: Skincare, Facial, Hair Treatment, Head Japanese Spa & Nail Art terbaik di Banda Aceh.') }}">
    
    <!-- Open Graph / Meta -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ setting('seo.meta_title', 'Putri Beauty Care') }}">
    <meta property="og:description" content="{{ setting('seo.meta_description') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>
<body class="bg-[#FFF5F9] text-[#3B1A2B] font-sans antialiased min-h-screen selection:bg-[#E6107A] selection:text-white flex flex-col items-center justify-start">

    <!-- Kontainer Terpusat Bergaya Poster / Linktree Modern -->
    <div class="w-full max-w-xl min-h-screen bg-white shadow-2xl relative flex flex-col overflow-hidden border-x border-[#FFE4EF]/60">
        @yield('content')
    </div>

    <!-- Floating WhatsApp Button -->
    @if(setting('appearance.show_floating_wa', true))
        <a href="https://wa.me/{{ \App\Services\WhatsAppLink::cleanPhoneNumber(setting('contact.whatsapp_main', '6281362673728')) }}?text={{ rawurlencode(setting('whatsapp_templates.consultation', 'Halo Putri Beauty Care 👋')) }}"
           target="_blank"
           rel="noopener noreferrer"
           aria-label="Chat WhatsApp Putri Beauty Care"
           class="group flex items-center gap-2 text-white p-3 sm:px-4 sm:py-3 rounded-full hover:scale-105 transition-all duration-300 active:scale-95"
           style="position: fixed !important; bottom: 20px !important; right: 20px !important; z-index: 9999 !important; background-color: #25D366 !important; box-shadow: 0 4px 16px rgba(37, 211, 102, 0.45) !important;">
            <i class="fa-brands fa-whatsapp text-2xl leading-none"></i>
            <span class="hidden sm:inline-block font-semibold text-xs sm:text-sm tracking-wide">Tanya Salon</span>
        </a>
    @endif

</body>
</html>
