<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Like;
use App\Models\User;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Category;


class LikeTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLikeIndex()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(action('App\Http\Controllers\LikesController@index', $user->id));
        $response->assertStatus(200)->assertViewIs('like.index');
    }

    public function testLikeStore()
    {
        $shop = Shop::factory()->for(Area::factory()->state([
            'area_name' => '新橋',
        ]))->for(Category::factory()->state([
            'category_name' => '中華',
        ]))->create();

        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post(action('App\Http\Controllers\LikesController@store', $shop->id));
        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'shop_id' => $shop->id
        ]);
        $response = $this->get(action('App\Http\Controllers\ShopsController@show', $shop->id));
        $response->assertStatus(200)->assertViewIs('shop.show')->assertSee('お気に入りのお店');
    }

    public function testLikeDestroy()
    {
        $shop = Shop::factory()->for(Area::factory()->state([
            'area_name' => '新橋',
        ]))->for(Category::factory()->state([
            'category_name' => '中華',
        ]))->create();
        
        $user = User::factory()->create();
        $this->actingAs($user);
        $like = Like::factory()->create([
            'user_id' => $user->id,
            'shop_id' => $shop->id
        ]);
        $response = $this->delete(action('App\Http\Controllers\LikesController@destroy', ['shop' => $shop->id, 'like' => $like->id]));
        $this->assertDeleted('likes', [
            'user_id' => $user->id,
            'shop_id' => $shop->id
        ]);
        $response = $this->get(action('App\Http\Controllers\ShopsController@show', $shop->id));
        $response->assertStatus(200)->assertViewIs('shop.show')->assertSee('気になるお店に登録');
    }
}
