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
        Schema::create('lead_automation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('leads')->onDelete('cascade');
            $table->string('assist_status')->nullable();
            $table->string('assist_substatus')->nullable();
            $table->timestamp('estimated_payment')->nullable();
            $table->timestamp('billetdue_date')->nullable();
            $table->timestamp('renewal_date');
            $table->integer('selected_menu')->nullable();
            $table->string('current_state')->nullable();
            $table->date('birthday')->nullable();
            $table->date('wedding')->nullable();
            $table->date('company_niver')->nullable();
            $table->string('holidays')->nullable();
            $table->string('important_updates')->nullable();
            $table->json('active_days')->nullable();
            $table->timestamp('periodic_contact')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_automation');
    }
};
