<?php

namespace App\Http\Controllers;
use App\Models\Friends;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MyFriendsController extends Controller
{
    public function index()
    {
        $friends = Auth::user()->friends();

        $friendsRequests = Auth::user()->friendRequests();

        return view('mypage.friends.index',compact('friends', 'friendsRequests'));
    }
}
