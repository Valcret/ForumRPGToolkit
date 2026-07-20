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
        Schema::table('image_infos', function (Blueprint $table) {
            $table->boolean('tattoo')->default(false);
            $table->boolean('piercing')->default(false);
            $table->boolean('nsfw')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('image_infos', function (Blueprint $table) {
            $table->dropColumn(['tattoo', 'piercing', 'nsfw']);
        });
    }
};
