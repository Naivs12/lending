<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) { 
            $table->id();
            $table->string('loan_id')->unique();
            $table->string('client_id');
            $table->string('branch_id');
            $table->integer('amount');
            $table->enum('payment_schedule', ['weekly', 'two_weeks', 'monthly', 'interest_only']);
            $table->string('term');
            $table->integer('interest');
            $table->date('date_release');
            $table->string('status');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('branch_id')->references('branch_id')->on('branches')->onDelete('cascade');
            $table->foreign('client_id')->references('client_id')->on('clients')->onDelete('cascade');
        });

         
    }


    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
