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
        Schema::create('trip_plan_stops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_plan_id')->constrained()->cascadeOnDelete();
            $table->foreignId('stop_id')->constrained()->cascadeOnDelete();
            $table->time('departure_time');
            $table->unique(['trip_plan_id', 'stop_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_plan_stops');
    }
};
