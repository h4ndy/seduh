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
        Schema::create('cash_book_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cash_book_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['income', 'expense','transfer_in','transfer_out']);
            $table->date('date_transaction');
            $table->integer('cash_book_from_to')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_book_transactions');
    }
};
