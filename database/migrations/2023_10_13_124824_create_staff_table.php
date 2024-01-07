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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('Fname');
            $table->string('Lname');
            $table->integer('Phone_no')->nullable();
            $table->string('Email');
            $table->string('Dept');
            $table->string('Position');
        });
    }

   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
