<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('branch_id')->unique();
            $table->string('branch_name');
            $table->string('address');
            $table->string('contact_number');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('branches');
    }
};
