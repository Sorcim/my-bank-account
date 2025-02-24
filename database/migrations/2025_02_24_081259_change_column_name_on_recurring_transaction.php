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
        Schema::table('recurring_transactions', function (Blueprint $table) {
            $table->renameColumn('lastProcessed_at', 'last_processed_at');
            $table->renameColumn('nextProcessed_at', 'next_processed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recurring_transactions', function (Blueprint $table) {
            $table->renameColumn('last_processed_at', 'lastProcessed_at');
            $table->renameColumn('next_processed_at', 'nextProcessed_at');
        });
    }
};
