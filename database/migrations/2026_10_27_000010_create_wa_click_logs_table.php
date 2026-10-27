<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wa_click_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action_type', 50); // booking_submit, catalog_inquiry, promo_claim, consultation_click, floating_click
            $table->string('item_type', 50)->nullable(); // catalog_item, promo, general
            $table->unsignedBigInteger('item_id')->nullable();
            $table->string('source_page', 100)->nullable();
            $table->string('ip_hash', 64)->nullable(); // salted SHA-256 hash for privacy
            $table->string('user_agent', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wa_click_logs');
    }
};
