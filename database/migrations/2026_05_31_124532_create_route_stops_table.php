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
        Schema::create('route_stops', function (Blueprint $table) {
            $table->foreignId('route_id')->constrained()->cascadeOnDelete();
            $table->foreignId('stop_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('sequence_number');
            $table->primary(['route_id', 'stop_id']);
            $table->unique(['route_id', 'sequence_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_stops');
    }
};
