<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required|image|file|mimes:jpg,png',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'ファイルが添付されていません',
            "image" => '指定されたファイルが画像ではありません',
            "mimes" => 'アップロードできるのはJPG・PNGファイルのみです'
        ];
    }
}
