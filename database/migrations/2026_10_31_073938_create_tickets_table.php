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
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('screening_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('row')->unsigned();
            $table->tinyInteger('seat')->unsigned();
            $table->enum('status', ['pending','paid','cancelled'])->default('pending');
            $table->string('qr_code', 64)->unique();
            $table->boolean('email_sent')->default(false);
            $table->timestamps();

            $table->unique(['screening_id', 'row', 'seat']);
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
