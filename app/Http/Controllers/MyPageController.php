<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MyPageController extends Controller
{
    public function index(Request $request,$nickname)
    {
        $user = User::where('nickname',$nickname)->get();

        return view("mypage.my_page",compact('user'));
    }


}
