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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('isAdmin')->default(false);
            $table->date('dateBirth')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->string('phone')->nullable();
            $table->integer('workTime')->nullable();
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['isAdmin', 'dateBirth', 'address_id', 'phone', 'workTime']);
        });
    }
};
