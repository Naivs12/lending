<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) { 
            $table->id();
            $table->string('loan_id');
            $table->string('client_id');
            $table->string('branch_id');
            $table->string('term');
            $table->integer('amount');
            $table->integer('amount_due');
            $table->date('payment_date');
            $table->date('due_date');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('branch_id')->references('branch_id')->on('branches')->onDelete('cascade');
            $table->foreign('client_id')->references('client_id')->on('clients')->onDelete('cascade');
            $table->foreign('loan_id')->references('loan_id')->on('loans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transations');
    }
};
