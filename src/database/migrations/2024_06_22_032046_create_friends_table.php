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
        Schema::create('friends', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('friend');

            $table->index('user', 'user_friend_user_idx');
            $table->index('friend', 'user_friend_friend_idx');

            $table->foreign('user', 'user_friend_user_fk')->on('users')->references('id');
            $table->foreign('friend', 'user_friend_friend_fk')->on('users')->references('id');

            $table->string('friendship_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friends');
    }
};
