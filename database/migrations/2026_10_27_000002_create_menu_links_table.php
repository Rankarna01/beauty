<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_links', function (Blueprint $table) {
            $table->id();
            $table->string('label', 100);
            $table->string('description', 255)->nullable();
            $table->string('icon', 100)->nullable();
            $table->string('badge_text', 50)->nullable();
            $table->string('type', 30)->default('internal_route'); // internal_route, external_url, whatsapp
            $table->string('url', 255);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_links');
    }
};
