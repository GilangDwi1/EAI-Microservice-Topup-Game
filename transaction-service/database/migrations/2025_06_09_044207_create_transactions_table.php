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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // auto increment BIGINT primary key
            $table->unsignedBigInteger('user_id');  // dari user-service
            $table->unsignedBigInteger('game_id');  // dari game-service
            $table->integer('jumlah_topup');
            $table->integer('total_harga');
            $table->string('status')->default('pending'); // pending, success, failed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
