<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsInvTable extends Migration
{
    public function up()
    {
        Schema::create('transactions_inv', function (Blueprint $table) {
            $table->id();
            $table->string('investor_id');
            $table->date('payment_date')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->timestamps();

            $table->foreign('investor_id')->references('investor_id')->on('investors')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions_inv');
    }
}