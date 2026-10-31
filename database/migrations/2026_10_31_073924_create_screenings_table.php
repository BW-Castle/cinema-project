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
        Schema::create('screenings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constrained()->cascadeOnDelete();
            $table->foreignId('hall_id')->constrained()->cascadeOnDelete();
            $table->dateTime('start_time');
            $table->enum('format', ['2D','3D','IMAX','VIP'])->default('2D');
            $table->decimal('ticket_price', 8, 2);
            $table->timestamps();
            
            $table->index(['hall_id', 'start_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screenings');
    }
};
