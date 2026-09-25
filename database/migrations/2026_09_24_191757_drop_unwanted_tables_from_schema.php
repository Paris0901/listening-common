<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('distribution_drafts');
        Schema::dropIfExists('analytics_events');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not restored as these tables were purged per simplified CRM architecture
    }
};
