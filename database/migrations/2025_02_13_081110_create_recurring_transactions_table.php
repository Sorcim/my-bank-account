<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recurring_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->string('description');
            $table->date('start_at');
            $table->date('end_at');
            $table->enum('frequency', ['daily', 'weekly', 'monthly', 'yearly']);
            $table->date('lastProcessed_at')->nullable();
            $table->date('nextProcessed_at');
            $table->foreignUuid('category_id')->nullable();
            $table->foreignUuid('bank_account_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recurring_transactions');
    }
};
