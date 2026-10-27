<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuLinkResource\Pages;
use App\Models\MenuLink;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MenuLinkResource extends Resource
{
    protected static ?string $model = MenuLink::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'Tampilan & Outlet';

    protected static ?string $modelLabel = 'Tombol Menu Beranda';

    protected static ?string $pluralModelLabel = 'Tombol Menu Beranda';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Konfigurasi Tombol Menu Beranda')
                    ->description('Tombol-tombol berbentuk pill yang tampil pada beranda linktree Putri Beauty Care')
                    ->schema([
                        Forms\Components\TextInput::make('label')
                            ->label('Judul Tombol (Label)')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('contoh: Booking Treatment Online'),

                        Forms\Components\TextInput::make('description')
                            ->label('Deskripsi Sub-teks')
                            ->maxLength(150)
                            ->placeholder('contoh: Pilih jadwal dan layanan favoritmu'),

                        Forms\Components\TextInput::make('url')
                            ->label('URL Tautan Tujuan')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('contoh: /booking atau https://wa.me/...'),

                        Forms\Components\Select::make('type')
                            ->label('Tipe Tautan')
                            ->options([
                                'internal' => 'Halaman Internal Website',
                                'external' => 'Tautan Eksternal (Buka Tab Baru)',
                                'whatsapp' => 'WhatsApp Langsung',
                            ])
                            ->default('internal')
                            ->required(),

                        Forms\Components\Select::make('icon')
                            ->label('Ikon Tombol')
                            ->options([
                                'calendar' => '📅 Kalender / Booking Jadwal',
                                'tag' => '🏷️ Label Harga / Price Tag',
                                'percent' => '🎁 Persentase Diskon / Promo',
                                'facial' => '💆‍♀️ Wajah / Skincare & Facial',
                                'spa' => '💇‍♀️ Rambut, Kuku & Japanese Head Spa',
                                'whatsapp' => '💬 Chat Bubble / Konsultasi WhatsApp',
                                'location' => '📍 Pin Lokasi / Google Maps',
                                'instagram' => '📷 Kamera / Instagram Feed',
                                'sparkles' => '✨ Sparkles / Kilau Cantik',
                            ])
                            ->default('sparkles')
                            ->searchable(),

                        Forms\Components\TextInput::make('badge_text')
                            ->label('Label Badge Khusus')
                            ->placeholder('contoh: POPULER, NEW, PROMO')
                            ->maxLength(50),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan Tampilan')
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka lebih kecil tampil lebih atas/dulu'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Tampilkan di Beranda')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('No')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('label')
                    ->label('Judul Tombol')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (MenuLink $record) => $record->description),

                Tables\Columns\TextColumn::make('url')
                    ->label('URL Tujuan')
                    ->copyable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'internal' => 'primary',
                        'whatsapp' => 'success',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('badge_text')
                    ->label('Badge')
                    ->badge()
                    ->color('warning')
                    ->placeholder('-'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->alignCenter(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenuLinks::route('/'),
            'create' => Pages\CreateMenuLink::route('/create'),
            'edit' => Pages\EditMenuLink::route('/{record}/edit'),
        ];
    }
}
