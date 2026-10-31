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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('slug', 200)->unique();
            $table->text('description')->nullable();
            $table->smallInteger('duration')->unsigned(); // минуты
            $table->year('release_year');
            $table->enum('age_rating', ['0+','6+','12+','16+','18+'])->default('0+');
            $table->string('poster_url', 500)->nullable();
            $table->string('trailer_url', 500)->nullable();
            $table->string('seo_title', 200)->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
