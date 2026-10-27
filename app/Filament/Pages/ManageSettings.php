<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Sistem & Pengguna';

    protected static ?string $title = 'Pengaturan Global Website';

    protected static ?string $navigationLabel = 'Pengaturan';

    protected static ?int $navigationSort = 2;

    protected static ?string $slug = 'manage-settings';

    protected static string $view = 'filament.pages.manage-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            // Identitas
            'general_brand_name' => setting('general.brand_name', 'Putri Beauty Care'),
            'general_tagline' => setting('general.tagline', 'Salon, Aesthetic & Skincare'),
            'general_slogan' => setting('general.slogan', 'Your Beauty, Our Care'),
            'general_footer_text' => setting('general.footer_text', 'Salon, Skincare & Aesthetic Banda Aceh · Follow for more updates'),
            'general_logo' => setting('general.logo'),
            'general_cover_photo' => setting('general.cover_photo'),

            // Kontak
            'contact_whatsapp_main' => setting('contact.whatsapp_main', '6281362673728'),
            'contact_whatsapp_consultation' => setting('contact.whatsapp_consultation', '6281362673728'),
            'contact_email' => setting('contact.email', 'putribeautycare.id@gmail.com'),

            // Sosmed
            'social_instagram_username' => setting('social.instagram_username', 'putribeautycare'),
            'social_instagram_url' => setting('social.instagram_url', 'https://instagram.com/putribeautycare'),
            'social_tiktok_url' => setting('social.tiktok_url'),

            // Template WA
            'whatsapp_booking' => setting('whatsapp_templates.booking', "Halo Putri Beauty Care 👋\nSaya ingin booking:\n\nNama     : {nama}\nLayanan  : {layanan}\nTanggal  : {tanggal}\nJam      : {jam}\nCatatan  : {catatan}\n\nMohon info ketersediaan jadwalnya, terima kasih 🙏"),
            'whatsapp_catalog_item' => setting('whatsapp_templates.catalog_item', "Halo Putri Beauty Care 👋\nSaya tertarik dengan {nama_produk} ({harga}).\nApakah slot / stok masih tersedia?\n{url_item}"),
            'whatsapp_consultation' => setting('whatsapp_templates.consultation', "Halo kak, saya ingin konsultasi tentang perawatan kecantikan di Putri Beauty Care 👋"),
            'whatsapp_promo_claim' => setting('whatsapp_templates.promo_claim', "Halo Putri Beauty Care 👋\nSaya ingin klaim promo: *{promo_title}*.\nMohon info syarat dan jadwal yang tersedia, terima kasih 🙏"),

            // Tampilan & Chip
            'appearance_show_floating_wa' => (bool) setting('appearance.show_floating_wa', true),
            'appearance_featured_service_chips' => setting('appearance.featured_service_chips', [
                'Facial Treatment',
                'Hair Cut',
                'Creambath',
                'Hairmask',
                'Manicure',
                'Nail Art',
                'Head Japanese Spa',
            ]),

            // SEO & Analitik
            'seo_meta_title' => setting('seo.meta_title', 'Putri Beauty Care – Salon, Aesthetic & Skincare Banda Aceh'),
            'seo_meta_description' => setting('seo.meta_description', 'Katalog resmi dan booking perawatan Putri Beauty Care: Skincare, Facial, Hair Treatment, Head Japanese Spa & Nail Art terbaik di Banda Aceh.'),
            'analytics_enable_wa_logging' => (bool) setting('analytics.enable_wa_logging', true),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Pengaturan')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Identitas Brand')
                            ->icon('heroicon-o-sparkles')
                            ->schema([
                                Forms\Components\TextInput::make('general_brand_name')
                                    ->label('Nama Brand Salon')
                                    ->required(),
                                Forms\Components\TextInput::make('general_tagline')
                                    ->label('Tagline Brand')
                                    ->required(),
                                Forms\Components\TextInput::make('general_slogan')
                                    ->label('Slogan Estetik')
                                    ->placeholder('Your Beauty, Our Care'),
                                Forms\Components\Textarea::make('general_footer_text')
                                    ->label('Teks Footer Halaman')
                                    ->rows(2)
                                    ->columnSpanFull(),
                                Forms\Components\FileUpload::make('general_logo')
                                    ->label('Logo Salon')
                                    ->image()
                                    ->directory('branding'),
                                Forms\Components\FileUpload::make('general_cover_photo')
                                    ->label('Foto Cover Header')
                                    ->image()
                                    ->directory('branding'),
                            ])->columns(2),

                        Forms\Components\Tabs\Tab::make('Kontak & Sosmed')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Forms\Components\TextInput::make('contact_whatsapp_main')
                                    ->label('Nomor WhatsApp Utama (Booking)')
                                    ->helperText('Contoh: 081362673728 atau 6281362673728 (akan otomatis dinormalisasi)')
                                    ->required(),
                                Forms\Components\TextInput::make('contact_whatsapp_consultation')
                                    ->label('Nomor WhatsApp Konsultasi')
                                    ->helperText('Bisa sama atau berbeda dengan nomor utama')
                                    ->required(),
                                Forms\Components\TextInput::make('contact_email')
                                    ->label('Email Kontak')
                                    ->email(),
                                Forms\Components\TextInput::make('social_instagram_username')
                                    ->label('Username Instagram')
                                    ->prefix('@'),
                                Forms\Components\TextInput::make('social_instagram_url')
                                    ->label('URL Profil Instagram')
                                    ->url(),
                                Forms\Components\TextInput::make('social_tiktok_url')
                                    ->label('URL TikTok (Opsional)')
                                    ->url(),
                            ])->columns(2),

                        Forms\Components\Tabs\Tab::make('Template WhatsApp')
                            ->icon('heroicon-o-chat-bubble-oval-left-ellipsis')
                            ->schema([
                                Forms\Components\Textarea::make('whatsapp_booking')
                                    ->label('Template Pesan Form Booking')
                                    ->helperText('Placeholder tersedia: {nama}, {layanan}, {tanggal}, {jam}, {catatan}')
                                    ->rows(7)
                                    ->required(),

                                Forms\Components\Textarea::make('whatsapp_catalog_item')
                                    ->label('Template Pesan Tanya Layanan/Produk')
                                    ->helperText('Placeholder tersedia: {nama_produk}, {harga}, {url_item}')
                                    ->rows(5)
                                    ->required(),

                                Forms\Components\Textarea::make('whatsapp_consultation')
                                    ->label('Template Pesan Tombol Konsultasi')
                                    ->rows(3)
                                    ->required(),

                                Forms\Components\Textarea::make('whatsapp_promo_claim')
                                    ->label('Template Klaim Promo')
                                    ->helperText('Placeholder tersedia: {promo_title}')
                                    ->rows(4)
                                    ->required(),
                            ]),

                        Forms\Components\Tabs\Tab::make('Tampilan & Layanan Unggulan')
                            ->icon('heroicon-o-paint-brush')
                            ->schema([
                                Forms\Components\Toggle::make('appearance_show_floating_wa')
                                    ->label('Tampilkan Tombol Mengambang (Floating WhatsApp) di Seluruh Halaman')
                                    ->default(true),

                                Forms\Components\TagsInput::make('appearance_featured_service_chips')
                                    ->label('Chip Layanan Unggulan Beranda (Tekan Enter)')
                                    ->placeholder('Tambah chip layanan...')
                                    ->helperText('Ditampilkan di bawah header profil beranda')
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Tabs\Tab::make('SEO & Analitik')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                Forms\Components\TextInput::make('seo_meta_title')
                                    ->label('Judul Default Website (Meta Title)')
                                    ->required(),
                                Forms\Components\Textarea::make('seo_meta_description')
                                    ->label('Deskripsi Default Website (Meta Description)')
                                    ->rows(3)
                                    ->required(),
                                Forms\Components\Toggle::make('analytics_enable_wa_logging')
                                    ->label('Aktifkan Pencatatan Klik WhatsApp (Analitik Minat Pengunjung)')
                                    ->default(true),
                            ]),
                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $state = $this->form->getState();

        // Simpan setiap item ke tabel settings
        Setting::setValue('general.brand_name', $state['general_brand_name'], 'general', 'string');
        Setting::setValue('general.tagline', $state['general_tagline'], 'general', 'string');
        Setting::setValue('general.slogan', $state['general_slogan'], 'general', 'string');
        Setting::setValue('general.footer_text', $state['general_footer_text'], 'general', 'string');
        Setting::setValue('general.logo', $state['general_logo'], 'general', 'string');
        Setting::setValue('general.cover_photo', $state['general_cover_photo'], 'general', 'string');

        Setting::setValue('contact.whatsapp_main', $state['contact_whatsapp_main'], 'contact', 'string');
        Setting::setValue('contact.whatsapp_consultation', $state['contact_whatsapp_consultation'], 'contact', 'string');
        Setting::setValue('contact.email', $state['contact_email'], 'contact', 'string');

        Setting::setValue('social.instagram_username', $state['social_instagram_username'], 'social', 'string');
        Setting::setValue('social.instagram_url', $state['social_instagram_url'], 'social', 'string');
        Setting::setValue('social.tiktok_url', $state['social_tiktok_url'], 'social', 'string');

        Setting::setValue('whatsapp_templates.booking', $state['whatsapp_booking'], 'whatsapp_templates', 'text');
        Setting::setValue('whatsapp_templates.catalog_item', $state['whatsapp_catalog_item'], 'whatsapp_templates', 'text');
        Setting::setValue('whatsapp_templates.consultation', $state['whatsapp_consultation'], 'whatsapp_templates', 'text');
        Setting::setValue('whatsapp_templates.promo_claim', $state['whatsapp_promo_claim'], 'whatsapp_templates', 'text');

        Setting::setValue('appearance.show_floating_wa', $state['appearance_show_floating_wa'], 'appearance', 'boolean');
        Setting::setValue('appearance.featured_service_chips', $state['appearance_featured_service_chips'], 'appearance', 'json');

        Setting::setValue('seo.meta_title', $state['seo_meta_title'], 'seo', 'string');
        Setting::setValue('seo.meta_description', $state['seo_meta_description'], 'seo', 'string');
        Setting::setValue('analytics.enable_wa_logging', $state['analytics_enable_wa_logging'], 'analytics', 'boolean');

        Notification::make()
            ->title('Pengaturan Berhasil Disimpan')
            ->body('Seluruh perubahan konfigurasi dan pesan WhatsApp langsung berlaku di website.')
            ->success()
            ->send();
    }
}
