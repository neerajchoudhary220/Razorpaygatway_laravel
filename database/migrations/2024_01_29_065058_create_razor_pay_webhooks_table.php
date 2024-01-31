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
        Schema::create('razor_pay_webhooks', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id');
            $table->string('payment_order_id')->nullable();
            $table->decimal('amount',10,2)->default(0);
            $table->string('currency')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->string('event')->nullable(); 
            $table->string('status')->nullable();     


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('razor_pay_webhooks');
    }
};
