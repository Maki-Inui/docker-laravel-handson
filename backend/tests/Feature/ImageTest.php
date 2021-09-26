<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Image;
use App\Models\User;
use App\Models\Area;
use App\Models\Shop;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testImageStore()
    {
        //お店情報作成に必要なインスタンス作成
        $admin_user = User::factory()->state(['role_id' => '1'])->create();
        $shop = Shop::factory()->state(['name' => 'おむらいす店'])->for(Area::factory()->state(['area_name' => '原宿']))
        ->for(Category::factory()->state(['category_name' => '洋食']))->create();

        Storage::fake('image');
        $file = UploadedFile::fake()->image('shop_image.jpg');
        $file_name = time() . $file->getClientOriginalName();
        $response = $this->actingAs($admin_user)->post(action('App\Http\Controllers\ImagesController@store', $shop), ['image' => $file]);
        $this->assertDatabaseHas('images', ['path' => $file_name]);
        $response = $this->get(action('App\Http\Controllers\ShopsController@edit', $shop));
        $response->assertViewIs('shop.edit')->assertSee('画像を追加しました');
        $path = public_path('image/shop/' . $file_name);
        \File::delete($path);
    }

    public function testImageDestroy()
    {
        //お店情報作成に必要なインスタンス作成
        $admin_user = User::factory()->state(['role_id' => '1'])->create();
        $shop = Shop::factory()->state(['name' => 'おむらいす店'])->for(Area::factory()->state(['area_name' => '原宿']))
        ->for(Category::factory()->state(['category_name' => '洋食']))->create();

        $image = Image::factory()->state(['path' => time() . 'shop_image', 'shop_id' => $shop->id])->create();
        $response = $this->actingAs($admin_user)->delete(action('App\Http\Controllers\ImagesController@destroy', ['shop' => $shop, 'image' => $image->id]));
        $this->assertDeleted('images', [
            'shop_id' => $shop->id,
            'path' => $image->path
        ]);
        $response = $this->get(action('App\Http\Controllers\ShopsController@edit', $shop));
        $response->assertViewIs('shop.edit')->assertSee('画像を削除しました');
    }

}
