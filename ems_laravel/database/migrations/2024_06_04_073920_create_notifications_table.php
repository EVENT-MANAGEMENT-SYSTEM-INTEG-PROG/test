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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notification_id');
            $table->unsignedBigInteger('user_id');
            $table->string('notification_message');
            $table->string('notification_status');
            $table->string('notification_type');
            $table->timestamp('notification_date_time');
            $table->timestamps();
            $table->string('organizer');
            $table->json('participants')->nullable();
            
            // Make schedule_id nullable
            $table->unsignedBigInteger('schedule_id')->nullable(); // Add the schedule_id as a nullable field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
