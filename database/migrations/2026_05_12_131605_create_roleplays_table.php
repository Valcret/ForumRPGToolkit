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
        Schema::create('roleplays', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('url', 255)->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('prequel')->nullable()->constrained('roleplays');
            $table->foreignId('sequel')->nullable()->constrained('roleplays');
            $table->foreignId('forum_id')->constrained('forums')->cascadeOnDelete();
            $table->date('started')->nullable();
            $table->date('ended')->nullable();
            $table->integer('current_sum')->default(0);
            $table->integer('max_turn')->default(0);
            $table->integer('current_turn')->default(1);
            $table->foreignId('status_id')->constrained('roleplay_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roleplays');
    }
};
