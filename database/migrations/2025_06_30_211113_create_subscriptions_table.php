<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->integer('durationDays')->nullable();
            $table->boolean('isActive')->nullable();
            $table->string('plan_type')->default('individual');
            $table->json('features')->nullable();
            $table->integer('max_team_members')->nullable();
            $table->boolean('has_team_access')->default(false);
            $table->boolean('has_enterprise_access')->default(false);
            $table->string('stripe_product_id')->nullable();
            $table->string('stripe_price_id')->nullable();
            $table->timestamp('last_synced_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
