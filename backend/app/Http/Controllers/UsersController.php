<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Follow;

class UsersController extends Controller
{
    public function index()
    {
        $all_users = User::all();
        return view('users.index', compact('all_users'));
    }

    public function show($id)
    {
        $user = User::find($id);

        if ($user === null)
        {
            return redirect()->route('users.index')->with('failure', '指定されたIDのアカウントは存在しません');
        }

        $following = Auth::user()->following($user->id);
        $followed = Auth::user()->followed($user->id);
        return view('users.show', compact('user', 'following', 'followed'));
    }
}
