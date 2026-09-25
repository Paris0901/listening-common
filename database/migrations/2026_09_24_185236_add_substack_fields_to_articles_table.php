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
        Schema::table('articles', function (Blueprint $table) {
            $table->string('substack_guid', 255)->nullable()->unique()->after('cover_url');
            $table->string('substack_url', 1024)->nullable()->after('substack_guid');
            $table->dateTime('substack_synced_at')->nullable()->after('substack_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['substack_guid', 'substack_url', 'substack_synced_at']);
        });
    }
};
