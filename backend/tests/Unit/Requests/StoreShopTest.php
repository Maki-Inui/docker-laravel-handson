<?php

namespace Tests\Unit\Requests;

use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreShop;
use Illuminate\Http\UploadedFile;

class StoreShopTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @dataProvider additionProvider
     */

    public function testStoreShop(array $keys, array $values, bool $expect)
    {
        $data_list = array_combine($keys, $values);
        $request = new StoreShop();
        $rules = $request->rules();
        $validator = Validator::make($data_list, $rules);
        $result = $validator->passes();
        $this->assertEquals($expect, $result);
    }

    public function additionProvider()
    {
        return [
            'OK' => [
                ['name', 'description', 'image'],
                ['お店の名前', '説明文', [UploadedFile::fake()->create('dummy.png')]],
                true
            ],
            'お店の名前が空白' => [
                ['name', 'description'],
                [null, '説明文'],
                false
            ],
            'お店の説明文が空白' => [
                ['name', 'description'],
                ['お店の名前', null],
                false
            ],
            'お店の名前が文字数超過' => [
                ['name', 'description'],
                [str_repeat('a', 11), '説明文'],
                false
            ],
            'お店の説明文が文字数超過' => [
                ['name', 'description'],
                ['お店の名前', str_repeat('a', 101)],
                false
            ],
            '画像の拡張子が違う' => [
                ['name', 'description', 'image'],
                ['お店の名前', '説明文', [UploadedFile::fake()->create('dummy.txt')]],
                false
            ],
        ];
    }
}
