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
        Schema::table('room_members', function (Blueprint $table) {
            $table->dropColumn('relationships_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('room_members', function (Blueprint $table) {
            $table->unsignedBigInteger('relationships_id')->nullable();
            $table->index('relationships_id', 'room_member_relationships_id_idx');
            $table->foreign('relationships_id', 'room_member_relationships_id_fk')->on('users')->references('id');
        });
    }
};
