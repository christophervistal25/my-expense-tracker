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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('payee')->nullable();
            $table->float('expense', 8, 3)->nullable();
            $table->float('income', 8, 3)->nullable();
            $table->float('savings', 8, 3)->nullable();
            $table->unsignedInteger('quantity')->nullable();
            $table->unsignedInteger('category_id');
            $table->string('transaction_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
