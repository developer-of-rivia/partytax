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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->float('price');
            $table->integer('count');


            $table->unsignedBigInteger('room_id');

            $table->index('room_id', 'expense_room_expense_idx');
            $table->foreign('room_id', 'expense_room_expense_fk')->on('rooms')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
