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
use App\Models\Photo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PhotoTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPhotoStore()
    {
        //レビュー作成に必要なインスタンス作成
        $shop = Shop::factory()->state(['name' => 'おむらいす店'])->for(Area::factory()->state(['area_name' => '原宿']))
        ->for(Category::factory()->state(['category_name' => '洋食']))->create();
        $user = User::factory()->create();
        $this->actingAs($user);
        $review = Review::factory()->state(['shop_id' => $shop->id, 'user_id' => $user->id])->create();

        Storage::fake('image');
        $file = UploadedFile::fake()->image('review_image.jpg');
        $file_name = time() . $file->getClientOriginalName();
        $response = $this->actingAs($user)->post(action('App\Http\Controllers\PhotosController@store', $review), ['image' => $file]);

        $this->assertDatabaseHas('photos', ['path' => $file_name]);
        
        $response = $this->actingAs($user)->get(action('App\Http\Controllers\ReviewsController@edit', ['shop' => $shop->id, 'review' => $review]));
        $response->assertViewIs('review.edit')->assertSee('写真を追加しました');

        //テスト後は画像を削除する
        $path = public_path('image/review/' . $file_name);
        \File::delete($path);
    }

    public function testPhotoDestroy()
    {
        //レビュー作成に必要なインスタンス作成
        $shop = Shop::factory()->state(['name' => 'おむらいす店'])->for(Area::factory()->state(['area_name' => '原宿']))
        ->for(Category::factory()->state(['category_name' => '洋食']))->create();
        $user = User::factory()->create();
        $this->actingAs($user);
        $review = Review::factory()->state(['shop_id' => $shop->id, 'user_id' => $user->id])->create();

        $photo = Photo::factory()->state(['path' => time() . 'review_image', 'review_id' => $review->id])->create();

        $response = $this->actingAs($user)->delete(action('App\Http\Controllers\PhotosController@destroy', ['shop' => $shop, 'review' => $review->id, 'photo' => $photo->id]));

        $this->assertDeleted('photos', [
            'review_id' => $review->id,
            'path' => $photo->path
        ]);

        $response = $this->actingAs($user)->get(action('App\Http\Controllers\ReviewsController@edit',  ['shop' => $shop->id, 'review' => $review]));
        $response->assertViewIs('review.edit')->assertSee('写真を削除しました');
    }
}
