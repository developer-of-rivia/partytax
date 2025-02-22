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
        Schema::create('room_subscribers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('room_id');

            $table->index('user_id', 'user_room_user_idx');
            $table->index('room_id', 'user_room_room_idx');

            $table->foreign('user_id', 'user_room_user_fk')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('room_id', 'user_room_room_fk')->on('rooms')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_subscribers');
    }
};
