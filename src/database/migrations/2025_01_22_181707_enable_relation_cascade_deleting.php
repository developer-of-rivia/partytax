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
        /* rooms */
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropIndex('creator_user_creator_idx');
            $table->dropForeign('creator_user_creator_fk');
            $table->dropColumn('creator_id');

        });
        Schema::table('rooms', function (Blueprint $table) {
            $table->unsignedBigInteger('creator_id');
            $table->index('creator_id', 'creator_user_creator_idx');
            $table->foreign('creator_id', 'creator_user_creator_fk')->on('users')->references('id')->onDelete('cascade');
        });


        /* rooms */
        Schema::table('room_members', function (Blueprint $table) {
            $table->dropIndex('room_member_room_idx');
            $table->dropForeign('room_member_room_fk');
            $table->dropColumn('room_id');

        });
        Schema::table('room_members', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id');
            $table->index('room_id', 'room_member_room_idx');
            $table->foreign('room_id', 'room_member_room_fk')->on('rooms')->references('id')->onDelete('cascade');
        });


        /* expenses */
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropIndex('expense_room_expense_idx');
            $table->dropForeign('expense_room_expense_fk');
            $table->dropColumn('room_id');

        });
        Schema::table('expenses', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id');
            $table->index('room_id', 'expense_room_expense_idx');
            $table->foreign('room_id', 'expense_room_expense_fk')->on('rooms')->references('id')->onDelete('cascade');
        });


        /* member_expenses */
        Schema::table('member_expenses', function (Blueprint $table) {
            $table->dropIndex('expense_room_expense_idx');
            $table->dropForeign('member_expense_member_fk');
            $table->dropColumn('member_id');


            $table->dropIndex('member_expense_expense_idx');
            $table->dropForeign('member_expense_expense_fk');
            $table->dropColumn('expense_id');

        });
        Schema::table('member_expenses', function (Blueprint $table) {
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('expense_id');

            $table->index('member_id', 'member_expense_member_idx');
            $table->index('expense_id', 'member_expense_expense_idx');

            $table->foreign('member_id', 'member_expense_member_fk')->on('room_members')->references('id')->onDelete('cascade');
            $table->foreign('expense_id', 'member_expense_expense_fk')->on('expenses')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
