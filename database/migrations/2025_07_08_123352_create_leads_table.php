<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('code')->default('1');
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->foreignId('broker_id')->nullable()->constrained('brokers')->onDelete('set null');
            $table->foreignId('responsible_id')->nullable()->constrained('brokers')->onDelete('set null');
            $table->foreignId('health_operator_id')->nullable()->constrained('health_operators')->onDelete('set null');
            $table->integer('type')->nullable();
            $table->string('status')->nullable();
            $table->string('cpf')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('name')->nullable();
            $table->string('corporateName')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('step')->default('1');
            $table->string('temperature')->nullable();
            $table->string('traking')->nullable();
            $table->string('source')->nullable();
            $table->boolean('isAutomation')->nullable();
            $table->integer('lifes')->nullable();
            $table->boolean('acceptContestation')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('startPrice', 10, 2)->nullable();
            $table->decimal('currentPrice', 10, 2)->nullable();
            $table->decimal('negotiatedPrice', 10, 2)->nullable();
            $table->string('pricingType')->nullable();
            $table->integer('depreciationPercent')->nullable();
            $table->integer('depreciationInterval')->nullable();
            $table->timestamp('lead_expires_at')->nullable();
            $table->timestamp('acquired_at')->nullable();
            $table->timestamps();

            $table->index('broker_id');
            $table->index('responsible_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
