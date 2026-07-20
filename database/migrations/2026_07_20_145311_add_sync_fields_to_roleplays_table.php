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
        Schema::table('roleplays', function (Blueprint $table) {
            $table->timestamp('last_post_at')->nullable()->after('current_turn');
            $table->string('last_post_author')->nullable()->after('last_post_at');
            $table->timestamp('last_synced_at')->nullable()->after('last_post_author');
        });
    }

    public function down(): void
    {
        Schema::table('roleplays', function (Blueprint $table) {
            $table->dropColumn(['last_post_at', 'last_post_author', 'last_synced_at']);
        });
    }
};
