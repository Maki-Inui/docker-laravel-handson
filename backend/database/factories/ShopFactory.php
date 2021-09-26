<?php

namespace Database\Factories;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->sentence,
            'category_id' => Category::factory(),
            'area_id' => Area::factory(),
        ];
    }
}
