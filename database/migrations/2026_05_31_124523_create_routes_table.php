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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('number', 10);
            $table->string('name', 255);
            $table->decimal('distance_km', 5, 3)->unsigned();
            $table->string('carrier_registration_number', 11);
            $table->foreign('carrier_registration_number')->references('registration_number')->on('carriers')->cascadeOnDelete();
            $table->unique(['name', 'carrier_registration_number']);
            $table->unique(['number', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
