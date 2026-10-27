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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
           class="fixed bottom-6 right-6 z-50 group flex items-center gap-2 bg-[#25D366] hover:bg-[#20bd5a] text-white p-3.5 sm:px-5 sm:py-3.5 rounded-full shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.392-10.416c-5.514 0-10 4.486-10 10 0 1.764.459 3.421 1.261 4.869l-1.341 4.903 5.02-1.316c1.397.763 2.99 1.199 4.685 1.199 5.514 0 10-4.486 10-10s-4.486-10-10-10z"/>
            </svg>
            <span class="hidden sm:inline-block font-semibold text-sm tracking-wide">Tanya Salon</span>
            <span class="absolute -top-1 -right-1 flex h-3.5 w-3.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-emerald-400"></span>
            </span>
        </a>
    @endif

</body>
</html>
