<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //お店の取得
        $shop = DB::table('shops')->first(); 
        $shop_1 = $shop->id;

        $shop = DB::table('shops')->skip(1)->first(); 
        $shop_2 = $shop->id;

        $shop = DB::table('shops')->skip(2)->first(); 
        $shop_3 = $shop->id;

        DB::table('images')->insert([
            [
                'shop_id' => $shop_1,
                'path' => 'hamburger.jpg'
            ],
            [
                'shop_id' => $shop_1,
                'path' => 'hamburger_shop_image2.jpg'
            ],
            [
                'shop_id' => $shop_1,
                'path' => 'hamburger_shop_image3.jpg'
            ],
            [
                'shop_id' => $shop_1,
                'path' => 'hamburger_shop_image4.jpg'
            ],
            [
                'shop_id' => $shop_2,
                'path' => '4641100_s.jpg'
            ],
            [
                'shop_id' => $shop_3,
                'path' => 'thai.jpg'
            ]
        ]);
    }
}
