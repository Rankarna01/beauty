<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PriceListController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;

// Beranda Utama Linktree
Route::get('/', [HomeController::class, 'index'])->name('home');

// Modul Katalog & Perawatan (Fase 3)
Route::get('/katalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/katalog/{category:slug}', [CatalogController::class, 'index'])->name('catalog.category');
Route::get('/katalog/{category:slug}/{item:slug}', [CatalogController::class, 'show'])->name('catalog.show');

// Modul Daftar Harga / Price List (Fase 3)
Route::get('/harga', [PriceListController::class, 'index'])->name('price-list');

// Modul Promo Dinamis (Fase 3)
Route::get('/promo', [PromoController::class, 'index'])->name('promo.index');
Route::get('/promo/{slug}', [PromoController::class, 'show'])->name('promo.show');

// Direct Redirection URLs (Konsultasi & Instagram)
Route::get('/konsultasi', [RedirectController::class, 'consultation'])->name('redirect.consultation');
Route::get('/instagram', [RedirectController::class, 'instagram'])->name('redirect.instagram');

use App\Http\Controllers\LocationController;

// Fitur Booking & Lokasi (Fase 4)
Route::view('/booking', 'pages.booking')->name('booking');
Route::get('/lokasi', [LocationController::class, 'index'])->name('locations');
