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
        Schema::create('member_expenses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('contribution');


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
