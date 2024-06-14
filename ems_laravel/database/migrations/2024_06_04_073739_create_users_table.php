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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->unsignedBigInteger('role_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('email')->unique();  
            $table->string('user_name')->unique();
            $table->string('password');
            $table->string('mobile_number', 11)->nullable();
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('post_code')->nullable();
            $table->string('country');
            $table->timestamps();
            $table->foreign('role_id')->references('role_id')->on('roles')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
