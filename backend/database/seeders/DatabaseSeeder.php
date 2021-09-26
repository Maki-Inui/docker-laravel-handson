<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AreaSeeder::class,
            CategorySeeder::class,
            ShopSeeder::class,
            ImageSeeder::class,
            UserSeeder::class,
            ReviewSeeder::class,
            PhotoSeeder::class
        ]);
    }
        
}
