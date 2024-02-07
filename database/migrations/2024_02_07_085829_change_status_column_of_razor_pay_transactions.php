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
        Schema::table('razor_pay_transactions', function (Blueprint $table) {
            $table->enum('status',['created','attempted','paid','failed'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('razor_pay_transactions', function (Blueprint $table) {
            $table->enum('status',['created','attempted','paid'])->change();
            
        });
    }
};
