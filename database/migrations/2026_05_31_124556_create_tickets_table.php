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
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('ticket_category_id')->constrained()->cascadeOnDelete()->default(1);
            $table->decimal('price', 10, 2);
            $table->timestamp('created_at')->useCurrent();
            $table->foreignId('trip_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tariff_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->uuid('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('payments')->nullOnDelete();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
