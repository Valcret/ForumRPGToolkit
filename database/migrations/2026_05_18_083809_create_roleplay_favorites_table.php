<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roleplay_favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('roleplay_id')->constrained('roleplays')->cascadeOnDelete();
            $table->unsignedInteger('priority_order')->default(0);
            $table->unique(['user_id', 'roleplay_id']);
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roleplay_favorites');
    }
};
