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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('leads')->onDelete('cascade');
            $table->string('name');
            $table->date('birth_date')->nullable();
            $table->string('relationship_type');
            $table->string('relationship_type_other')->nullable();
            $table->string('cpf')->nullable();
            $table->decimal('weight', 5, 2)->nullable();
            $table->decimal('height', 3, 2)->nullable();
            $table->text('additional_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
