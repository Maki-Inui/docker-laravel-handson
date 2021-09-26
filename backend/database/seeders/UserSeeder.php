<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $area = DB::table('areas')->first(); 
        $area_id = $area->id;

        DB::table('users')->insert([
            [
                'name' => 'maki',
                'profile' => '管理者です',
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'area_id' => $area_id,
                'role_id' => '1'
            ],
            [
                'name' => 'hanako',
                'profile' => '食べ歩きが趣味です',
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'area_id' => $area_id,
                'role_id' => '0'
            ]
        ]);
    }
}
