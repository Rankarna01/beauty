<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catalog_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('type', 30)->default('service'); // service, product
            $table->string('name', 200);
            $table->string('slug', 220)->unique();
            $table->string('short_description', 300)->nullable();
            $table->text('description')->nullable();
            $table->json('benefits')->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->string('price_type', 30)->default('fixed'); // fixed, starting_from, contact_us
            $table->unsignedInteger('price')->default(0);
            $table->unsignedInteger('price_max')->nullable();
            $table->unsignedInteger('compare_price')->nullable();
            $table->string('badge', 50)->nullable(); // e.g. "Best Seller", "Promo"
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catalog_items');
    }
};
