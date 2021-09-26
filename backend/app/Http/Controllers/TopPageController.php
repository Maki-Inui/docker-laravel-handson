<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopPageController extends Controller
{
    //トップページを表示
    public function show(){
        return view('top');
    }
}
