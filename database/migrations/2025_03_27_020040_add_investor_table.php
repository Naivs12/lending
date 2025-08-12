<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investors', function (Blueprint $table) { // Fix: table name should be plural for convention
            $table->id();
            $table->string('investor_id')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('address');
            $table->string('contact_number'); // Fix: Use string instead of int for phone numbers
            $table->integer('amount_invest');
            $table->integer('payment_percent');
            $table->string('branch_id'); // Changed from branch to branch_id
            $table->enum('payment_date', array_map('strval', range(1, 30)))->default('1');
            $table->timestamps(); // Adds created_at and updated_at columns

            $table->foreign('branch_id')->references('branch_id')->on('branches')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investors');
    }
};
