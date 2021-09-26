<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Category;
use App\Models\Visit;

class VisitTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testVisitIndex()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(action('App\Http\Controllers\VisitsController@index', $user->id));
        $response->assertStatus(200)->assertViewIs('visit.index');
    }

    public function testVisitStore()
    {
        $shop = Shop::factory()->for(Area::factory()->state([
            'area_name' => '新橋',
        ]))->for(Category::factory()->state([
            'category_name' => '中華',
        ]))->create();

        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post(action('App\Http\Controllers\VisitsController@store', $shop->id));
        $this->assertDatabaseHas('visits', [
            'user_id' => $user->id,
            'shop_id' => $shop->id
        ]);
        $response = $this->get(action('App\Http\Controllers\ShopsController@show', $shop->id));
        $response->assertStatus(200)->assertViewIs('shop.show')->assertSee('来店済み');
    }

    public function testVisitDestroy()
    {
        $shop = Shop::factory()->for(Area::factory()->state([
            'area_name' => '新橋',
        ]))->for(Category::factory()->state([
            'category_name' => '中華',
        ]))->create();
        
        $user = User::factory()->create();
        $this->actingAs($user);
        $visit = Visit::factory()->create([
            'user_id' => $user->id,
            'shop_id' => $shop->id
        ]);
        $response = $this->delete(action('App\Http\Controllers\VisitsController@destroy', ['shop' => $shop->id, 'visit' => $visit->id]));
        $this->assertDeleted('visits', [
            'user_id' => $user->id,
            'shop_id' => $shop->id
        ]);
        $response = $this->get(action('App\Http\Controllers\ShopsController@show', $shop->id));
        $response->assertStatus(200)->assertViewIs('shop.show')->assertSee('来店したらクリック');
    }
}
