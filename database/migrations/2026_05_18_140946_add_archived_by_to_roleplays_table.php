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
            $table->foreignId('archived_by')->nullable()->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('roleplays', function (Blueprint $table) {
            $table->dropForeign(['archived_by']);
            $table->dropColumn('archived_by');
        });
    }

};
