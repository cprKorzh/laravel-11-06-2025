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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->string('type');
            $table->string('payment');
            $table->integer('count');
            $table->string('address');
            $table->unsignedBigInteger('furniture_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            
            $table->foreign('furniture_id')->references('id')->on('furnitures');
            $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
