<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'category_name' => 'ハンバーガー',
            ],
            [
                'category_name' => 'エスニック',
            ],
            [
                'category_name' => 'ラーメン',
            ],
            [
                'category_name' => 'お寿司',
            ],
            [
                'category_name' => '焼き鳥',
            ]
        ]);
    }
}
