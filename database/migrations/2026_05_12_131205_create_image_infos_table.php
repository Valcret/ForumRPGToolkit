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
        Schema::create('image_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_id')->constrained('images')->cascadeOnDelete();
            $table->foreignId('eyes_color_id')->nullable()->constrained('eyes_colors');
            $table->foreignId('hair_color_id')->nullable()->constrained('hair_colors');
            $table->foreignId('hair_length_id')->nullable()->constrained('hair_lengths');
            $table->foreignId('size_id')->nullable()->constrained('sizes');
            $table->foreignId('history_id')->nullable()->constrained('histories');
            $table->foreignId('beard_id')->nullable()->constrained('beards');
            $table->foreignId('age_id')->nullable()->constrained('ages');
            $table->foreignId('image_size_id')->nullable()->constrained('image_sizes');
            $table->foreignId('gender_id')->nullable()->constrained('genders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_infos');
    }
};
