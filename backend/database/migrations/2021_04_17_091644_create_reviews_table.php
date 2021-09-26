<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id');  
            $table->foreignId('user_id');
            $table->string('title');
            $table->text('comment');
            $table->date('visit_day');
            $table->integer('time_frame');
            $table->string('image');
            $table->integer('recommend_score');
            $table->integer('food_score');
            $table->timestamps();

            $table->unique(['shop_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
