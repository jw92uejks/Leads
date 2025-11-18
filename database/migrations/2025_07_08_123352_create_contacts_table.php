<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->default('1');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null');
            $table->foreignId('broker_id')->nullable()->constrained('brokers')->onDelete('set null');
            $table->foreignId('responsible_id')->nullable()->constrained('brokers')->onDelete('set null');
            $table->foreignId('health_operator_id')->nullable()->constrained('health_operators')->onDelete('set null');
            $table->integer('type')->nullable();
            $table->string('status')->default('active');
            $table->string('cpf')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('name');
            $table->string('corporateName')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('email');
            $table->string('company')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('step')->nullable();
            $table->string('temperature')->nullable();
            $table->string('source')->default('manual');
            $table->boolean('isAutomation')->nullable();
            $table->integer('lifes')->nullable();
            $table->boolean('acceptContestation')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('startPrice', 10, 2)->nullable();
            $table->decimal('currentPrice', 10, 2)->nullable();
            $table->string('pricingType')->nullable();
            $table->integer('depreciationPercent')->nullable();
            $table->integer('depreciationInterval')->nullable();
            $table->timestamp('lead_expires_at')->nullable();
            $table->timestamp('acquired_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('last_contact_at')->nullable();
            $table->timestamp('converted_at')->nullable();
            $table->string('conversion_reason')->nullable();
            $table->timestamps();

            $table->index('broker_id');
            $table->index('responsible_id');
            $table->index('supplier_id');
            $table->index('email');
            $table->index('status');
            $table->index('source');
            $table->index('converted_at');
            $table->index(['status', 'source']);
            $table->index(['email', 'broker_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
