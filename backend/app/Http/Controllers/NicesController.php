<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nice;
use Illuminate\Support\Facades\Auth;

class NicesController extends Controller
{
    public function store(Request $request, $shop_id, $review_id)
    {
        $nice = new Nice();
        $nice->review_id = $review_id;
        $nice->user_id = Auth::user()->id;
        $nice->save();
        return redirect()->route('shops.show', ['shop' => $shop_id]);
    }

    public function destroy($shop_id, $review_id, $id)
    {
        Nice::find($id)->delete();
        return redirect()->route('shops.show', ['shop' => $shop_id]);
    }
}
