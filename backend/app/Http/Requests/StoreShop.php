<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShop extends FormRequest
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
            'name' => 'required|max:10',
            'description' => 'required|max:100',
            'image.*' => 'image|file|mimes:jpg,png',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'お店の名前を入力して下さい。',
            'name.max' => 'お店の名前は10文字以下で登録して下さい',
            'description.required' => 'お店の説明を入力して下さい。',
            'description.max' => 'お店の説明は100文字以下です',
            'image.*.image' => '画像を添付してください',
            'image.*.mimes' => '画像はjpgかpngのみです'
        ];
    }
}
