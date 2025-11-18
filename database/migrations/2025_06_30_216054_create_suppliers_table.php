<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('name')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('classification')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('stateRegistration')->nullable();
            $table->integer('rating')->nullable();
            $table->boolean('lgpdTerm')->nullable();
            $table->string('status')->nullable();
            $table->string('api_key')->nullable()->unique();
            $table->timestamp('approval_date_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
