<?php

namespace Tests\Unit\Requests;

use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreReview;
use Illuminate\Http\UploadedFile;

class StoreReviewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @dataProvider additionProvider
     */

    public function testStoreReview(array $keys, array $values, bool $expect)
    {
        $data_list = array_combine($keys, $values);
        $request = new StoreReview();
        $rules = $request->rules();
        $validator = Validator::make($data_list, $rules);
        $result = $validator->passes();
        $this->assertEquals($expect, $result);
    }

    public function additionProvider()
    {
        return [
            'OK' => [
                ['title', 'comment', 'image'],
                ['タイトル', 'レビューコメント', [UploadedFile::fake()->create('dummy.png')]],
                true
            ],
            'お店の名前が空白' => [
                ['title', 'comment'],
                [null, 'レビューコメント'],
                false
            ],
            'お店の説明文が空白' => [
                ['title', 'comment'],
                ['タイトル', null],
                false
            ],
            'お店の名前が文字数超過' => [
                ['title', 'comment'],
                [str_repeat('a', 15), 'レビューコメント'],
                false
            ],
            'お店の説明文が文字数超過' => [
                ['title', 'comment'],
                ['タイトル', str_repeat('a', 201)],
                false
            ],
            '画像の拡張子が違う' => [
                ['title', 'comment', 'image'],
                ['タイトル', 'レビューコメント', [UploadedFile::fake()->create('dummy.txt')]],
                false
            ],
        ];
    }
    
}
