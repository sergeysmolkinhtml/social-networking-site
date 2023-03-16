<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FriendsController extends Controller
{
    public function index()
    {
        $friends = Auth::user()->friends();

        return view('mypage.friends.index',compact('friends'));
    }
}
