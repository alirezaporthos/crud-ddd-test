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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'first_name');
            $table->string(column: 'last_name');
            $table->dateTime(column: 'date_of_birth');
            $table->unsignedBigInteger(column: 'phone_number');
            $table->string(column: 'email')->unique();
            $table->string(column: 'bank_account_number');
            $table->unique(columns: ['first_name', 'last_name', 'date_of_birth']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
