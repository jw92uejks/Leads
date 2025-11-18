<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('whatsapp_token_cache', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('personal_access_token_id')->constrained('personal_access_tokens')->onDelete('cascade');
            $table->text('encoded_token');
            $table->timestamp('expires_at');
            $table->boolean('is_blocked')->default(false);
            $table->text('blocked_reason')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('expires_at');
            $table->unique('personal_access_token_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whatsapp_token_cache');
    }
};

