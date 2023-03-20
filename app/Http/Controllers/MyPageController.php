<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    public function index(Request $request,$nickname)
    {
        $user = User::where('nickname',$nickname)->first();


        return view("mypage.my_page",compact('user'));
    }


}
