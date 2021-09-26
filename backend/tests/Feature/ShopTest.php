<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Shop;
use App\Models\User;
use App\Models\Area;
use App\Models\Category;
use App\Models\Review;
use App\Models\Visit;
use Carbon\Carbon;

class ShopTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShopIndex()
    {
        $response = $this->get(action('App\Http\Controllers\ShopsController@index'));
        $response->assertStatus(200)->assertViewIs('shop.index');
    }

    public function testVisitedShopIndex()
    {
        $shop = Shop::factory()->state(['name' => '中華B', 'description' => '餃子が絶品'])
            ->for(Area::factory()->state(['area_name' => '新橋']))
            ->for(Category::factory()->state(['category_name' => '中華']))->create();
        $user = User::factory()->create();

        Visit::factory()->create([
            'user_id' => $user->id,
            'shop_id' => $shop->id
        ]);

        $response = $this->get(action('App\Http\Controllers\ShopsController@visitedShopIndex'));
        $response->assertStatus(200)->assertViewIs('shop_visited.index', compact('shop'))->assertSee('中華B');
    }

    public function testShopCreate()
    {
        $areas = Area::factory(1)->create();
        $categories = Category::factory()->state(['category_name' => '中華'])->create();
        $admin_user = User::factory()->state(['role_id' => '1'])->create();
        $this->actingAs($admin_user);
        $response = $this->get(action('App\Http\Controllers\ShopsController@create', compact('areas', 'categories')));
        $response ->assertStatus(200)->assertViewIs('shop.create');
    }

    public function testShopStore()
    {
        //お店情報作成に必要なインスタンス作成
        $area = Area::factory()->state(['area_name' => '銀座'])->create();
        $category = Category::factory()->state(['category_name' => '中華'])->create();
        $admin_user = User::factory()->state(['role_id' => '1'])->create();

        //shopsテーブルに保存するデータ
        $data = [
            'area_id' => $area->id,
            'category_id' => $category->id,
            'name' => '中華レストランA',
            'description' => '小籠包が人気'
        ]; 

        $response = $this->actingAs($admin_user)->post(action('App\Http\Controllers\ShopsController@store', $data));
        $this->assertDatabaseHas('shops', [
            'area_id' => $area->id,
            'category_id' => $category->id,
            'description' => '小籠包が人気'
        ]);
        $response = $this->get(action('App\Http\Controllers\ShopsController@index'));
        $response->assertStatus(200)->assertViewIs('shop.index')->assertSee('中華レストランA');
    }

    public function testShopShow()
    {
        //shop.show bladeの表示に必要なデータを作成
        $user = User::factory()->create();
        $this->actingAs($user);
        $shop = Shop::factory()->state(['name' => '中華B', 'description' => '餃子が絶品'])
            ->for(Area::factory()->state(['area_name' => '新橋']))
            ->for(Category::factory()->state(['category_name' => '中華']))->create();
        Review::factory()->state(['shop_id' => $shop->id])->create();
        $reviews = Review::where('shop_id', $shop->id)->latest()->get();

        //お店の閲覧履歴：最新閲覧時刻を取得
        $last_view_at = Carbon::now(); 

        //Shopsコントローラーshowメソッドを呼び出す
        $response = $this->actingAs($user)->get(action('App\Http\Controllers\ShopsController@show', $shop->id, $reviews));

        //お店の閲覧履歴：DBにデータを保存できているかチェック
        $this->assertDatabaseHas('histories', [
            'shop_id' => $shop->id,
            'user_id' => $user->id,
            'last_view_at' => $last_view_at
        ]);

        $response->assertStatus(200)->assertViewIs('shop.show')->assertSee('餃子が絶品');
    }

    public function testShopEdit()
    {
        //お店情報作成に必要なインスタンス作成
        $admin_user = User::factory()->state(['role_id' => '1'])->create();
        $this->actingAs($admin_user);
        $shop = Shop::factory()->state(['name' => '中華B', 'description' => '餃子が絶品'])
            ->for(Area::factory()->state(['area_name' => '新橋']))
            ->for(Category::factory()->state(['category_name' => '中華']))->create();

        $response = $this->get(action('App\Http\Controllers\ShopsController@edit', $shop->id));
        $response->assertStatus(200)->assertViewIs('shop.edit');
    }

    public function testShopUpdate()
    {
        //お店情報に必要なインスタンス作成
        $admin_user = User::factory()->state(['role_id' => '1'])->create();
        $shop = Shop::factory()->state(['name' => '中華B', 'description' => '餃子が絶品'])
        ->for(Area::factory()->state(['area_name' => '新橋',]))
        ->for(Category::factory()->state(['category_name' => '中華']))->create();

        //shopsテーブルで更新したいデータ
        $update = ['name' => '中華B', 'description' => '水餃子が大人気です'];

        $response = $this->actingAs($admin_user)->put(action('App\Http\Controllers\ShopsController@update', $shop->id), $update);

        $this->assertDatabaseHas('shops', ['description' => '水餃子が大人気です']);
        
        //管理ユーザーの再取得
        $admin2 = User::find($admin_user->id);

        $response = $this->actingAs($admin2)->get(action('App\Http\Controllers\ShopsController@show', $shop->id));
        $response->assertStatus(200)->assertViewIs('shop.show');
        $response->assertSee('水餃子が大人気です');
    }

    public function testShopDestroy()
    {
        //お店情報に必要なインスタンス作成
        $admin_user = User::factory()->state(['role_id' => '1'])->create();
        $shop = Shop::factory()->state(['name' => 'おむらいす店'])->for(Area::factory()->state(['area_name' => '原宿']))
        ->for(Category::factory()->state(['category_name' => '洋食']))->create();

        $this->actingAs($admin_user);
        $response = $this->delete(action('App\Http\Controllers\ShopsController@destroy', ['shop' => $shop->id]));

        //shopsテーブルからデータが削除されているか
        $this->assertDatabaseMissing('shops', [
            'id' => $shop->id,
            'name' => 'おむらいす店'
        ]);
        $response = $this->get(action('App\Http\Controllers\ShopsController@index'));
        $response->assertStatus(200)->assertViewIs('shop.index')->assertSee('お店を削除しました');
    }

}

    
