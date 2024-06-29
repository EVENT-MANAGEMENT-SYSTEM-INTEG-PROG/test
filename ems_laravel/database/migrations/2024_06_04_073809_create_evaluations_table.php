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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id('evaluation_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('event_id');
            $table->integer('evaluation_rating');
            $table->string('remarks')->nullable();
            $table->string('evaluation_status')->nullable();
            $table->date('created_date_time');
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
