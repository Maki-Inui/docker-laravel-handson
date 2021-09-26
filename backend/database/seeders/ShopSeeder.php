<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Str;  

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $area = DB::table('areas')->first(); 
        $area_id_1 = $area->id;

        $area = DB::table('areas')->skip(2)->first(); 
        $area_id_3 = $area->id;

        $area = DB::table('areas')->skip(3)->first(); 
        $area_id_4 = $area->id;

        $category = DB::table('categories')->first(); 
        $category_id_1 = $category->id;

        $category = DB::table('categories')->skip(1)->first(); 
        $category_id_2 = $category->id;

        $category = DB::table('categories')->skip(2)->first(); 
        $category_id_3 = $category->id;

        DB::table('shops')->insert([
            [
                'name' => 'ハンバーガー店A',
                'description' => 'お店のダミーデータです',
                'category_id' => $category_id_1,
                'area_id' => $area_id_1,
                'recommend_score' => 5,
                'food_score' => 5,
            ],
            [
                'name' => 'ラーメン店B',
                'description' => 'お店のダミーデータです',
                'category_id' => $category_id_3,
                'area_id' => $area_id_3,
                'recommend_score' => 5,
                'food_score' => 5,
            ],
            [
                'name' => 'タイ料理店C',
                'description' => 'お店のダミーデータです',
                'category_id' => $category_id_2,
                'area_id' => $area_id_4,
                'recommend_score' => 5,
                'food_score' => 5,
            ]
        ]);
    }
}
