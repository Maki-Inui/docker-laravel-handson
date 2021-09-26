<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ユーザーーの取得
        $user = DB::table('users')->first(); 
        $admin_1 = $user->id;

        $user = DB::table('users')->skip(1)->first(); 
        $user_1 = $user->id;

        //お店の取得
        $shop = DB::table('shops')->first(); 
        $shop_id_1 = $shop->id;

        $shop = DB::table('shops')->skip(2)->first(); 
        $shop_id_3 = $shop->id;

        DB::table('reviews')->insert([
            [
                'shop_id' => $shop_id_1,
                'user_id' => $admin_1,
                'title' => 'レビューのダミーデータです',
                'comment' =>'バンズがふわふわでお肉がジューシー',
                'recommend_score' => 5,
                'food_score' => 5,
            ],
            [
                'shop_id' => $shop_id_3,
                'user_id' => $admin_1,
                'title' => 'レビューのダミーデータです',
                'comment' =>'しっかりとスパイシーです',
                'recommend_score' => 5,
                'food_score' => 5,
            ],
            [
                'shop_id' => $shop_id_1,
                'user_id' => $user_1,
                'title' => 'レビューのダミーデータです',
                'comment' =>'しっかりとスパイシーです',
                'recommend_score' => 5,
                'food_score' => 5,
            ]
        ]);
    }
}
