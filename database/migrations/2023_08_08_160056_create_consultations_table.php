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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->dateTime('startDate');
            $table->dateTime('endDate');
            $table->float('coast');
            $table->unsignedBigInteger('treatment_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('animal_id');
            $table->foreign('treatment_id')->references('id')->on('treatments');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('animal_id')->references('id')->on('animals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
