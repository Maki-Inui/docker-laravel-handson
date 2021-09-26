<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class HistoriesController extends Controller
{    
    public function index()
    {
        $histories = History::with('shop')->where('user_id', Auth::id())->orderby('last_view_at', 'desc')->get();
        return view('history.index', compact('histories'));
    }
}
