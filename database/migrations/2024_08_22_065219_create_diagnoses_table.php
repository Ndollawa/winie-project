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
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sickness_id'); // Foreign key
            $table->unsignedBigInteger('user_id'); // Foreign key
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('sickness_id')->references('id')->on('sicknesses');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnoses');
    }
};
