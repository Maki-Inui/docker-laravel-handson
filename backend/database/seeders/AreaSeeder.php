<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            [
                'area_name' => '表参道',
            ],
            [
                'area_name' => '渋谷',
            ],
            [
                'area_name' => '虎ノ門',
            ],
            [
                'area_name' => '赤坂',
            ],
            [
                'area_name' => '溜池山王',
            ]
        ]);
    }
}
