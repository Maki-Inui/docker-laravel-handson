<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //レビューの取得
        $review = DB::table('reviews')->first(); 
        $review_1 = $review->id;

        $review = DB::table('reviews')->skip(1)->first(); 
        $review_2 = $review->id;

        $review = DB::table('reviews')->skip(2)->first(); 
        $review_3 = $review->id;

        DB::table('photos')->insert([
            [
                'review_id' => $review_1,
                'path' => 'review01.jpg'
            ],
            [
                'review_id' => $review_2,
                'path' => 'review02.jpg'
            ],
            [
                'review_id' => $review_3,
                'path' => 'review03.jpg'
            ],
            [
                'review_id' => $review_1,
                'path' => 'review01-2.jpg'
            ],
            [
                'review_id' => $review_1,
                'path' => 'review01-3.jpg'
            ]
        ]);
    }
}
