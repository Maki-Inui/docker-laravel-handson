<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class VisitsController extends Controller
{   
    public function index()
    {
        $user_id = Auth::user()->id;
        $visits = Visit::with('shop')->where('user_id', $user_id)->get(); 
        return view('visit.index', compact('visits'));
    }

    public function store(Request $request, $shop_id)
    {
        $visit = new Visit();
        $visit->shop_id = $shop_id;
        $visit->user_id = Auth::user()->id;
        $visit->save();
        return redirect()->route('shops.show', ['shop' => $shop_id])->with('success', '来店済み登録完了');
    }

    public function destroy($shop_id, $id) {
        Visit::find($id)->delete();
        return redirect()->route('shops.show', ['shop' => $shop_id]);
    }
}
