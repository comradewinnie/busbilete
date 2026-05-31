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
        Schema::create('carriers', function (Blueprint $table) {
            $table->string('registration_number', 11)->primary();
            $table->string('name', 80)->unique();
            $table->string('phone', 20)->unique();
            $table->string('email', 255)->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carriers');
    }
};
