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
        Schema::create('razor_pay_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('razorpay_order_id');
            $table->decimal('amount',10,2)->default(0);
            $table->decimal('amount_due',10,2)->default(0);
            $table->decimal('amount_paid',10,2)->default(0);
            $table->string('receipt')->nullable();
            $table->enum('status',['created','attempted','paid']);
            $table->integer('attempts')->default(0);
            $table->json('notes')->nullable();
            $table->string('order_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('razor_pay_transactions');
    }
};
