<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Http\Requests\StoreImage;

class ImagesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  StoreReview $request
     * @param  int  $shop_id
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImage $request, $shop_id)
    {
        $image= new Image();
        $image->shop_id = $shop_id;
        $file = $request->file('image');
        $file_name = time() . $file->getClientOriginalName();
        $target_path = public_path('image/shop/');
        $file->move($target_path, $file_name);
        $image->path = $file_name;
        $image->save();
        $shop = $image->shop;

        return redirect()->route('shops.edit', compact('shop'))->with('success', '画像を追加しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $shop_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($shop_id, $id)
    {
        $image = Image::find($id);
        $shop = $image->shop;
        $path = public_path('image/shop/' . $image->path);
        \File::delete($path);
        $image->delete();
        return redirect()->route('shops.edit', compact('shop'))->with('success', '画像を削除しました');
    }
}
