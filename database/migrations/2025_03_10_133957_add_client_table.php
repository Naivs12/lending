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
        Schema::create('clients', function (Blueprint $table) { // Fix: table name should be plural for convention
            $table->id();
            $table->string('client_id')->unique();
            $table->string('name');
            $table->string('address');
            $table->date('birthday');
            $table->string('gender');
            $table->string('contact_number'); // Fix: Use string instead of int for phone numbers
            $table->string('soc_med')->nullable();
            $table->string('co_borrower')->nullable();
            $table->string('relationship_co')->nullable();
            $table->string('branch_id'); // Changed from branch to branch_id
            $table->foreign('branch_id')->references('branch_id')->on('branches')->onDelete('cascade'); // Foreign key
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
