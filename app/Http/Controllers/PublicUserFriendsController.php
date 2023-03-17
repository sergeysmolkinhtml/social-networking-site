<?php

namespace App\Http\Controllers;
use App\Models\Friends;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PublicUserFriendsController extends Controller
{
    public function index($nickname)
    {
        $user = User::where("nickname",$nickname)->first();



        return view('profile.partials.friends',compact('user'));
    }
}
