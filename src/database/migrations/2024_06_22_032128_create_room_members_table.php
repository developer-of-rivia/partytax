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
        Schema::create('room_members', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // room id
            $table->unsignedBigInteger('room_id');
            $table->index('room_id', 'room_member_room_idx');
            $table->foreign('room_id', 'room_member_room_fk')->on('rooms')->references('id')->onDelete('cascade');
            
            $table->string('name');
            
            // relation id
            $table->unsignedBigInteger('relationships_id')->nullable();
            $table->index('relationships_id', 'room_member_relationships_id_idx');
            $table->foreign('relationships_id', 'room_member_relationships_id_fk')->on('users')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_members');
    }
};
