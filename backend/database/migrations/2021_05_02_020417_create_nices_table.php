<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_id')->references('id')->on('reviews')->onDelete('cascade'); 
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade'); 
            $table->timestamps();

            $table->unique(['user_id', 'review_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nices');
    }
}
