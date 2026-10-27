<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catalog_item_promo', function (Blueprint $table) {
            $table->foreignId('catalog_item_id')->constrained('catalog_items')->cascadeOnDelete();
            $table->foreignId('promo_id')->constrained('promos')->cascadeOnDelete();
            $table->primary(['catalog_item_id', 'promo_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catalog_item_promo');
    }
};
