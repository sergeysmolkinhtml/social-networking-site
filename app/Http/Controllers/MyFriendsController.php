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


        return view('mypage.friends.index',
            compact('friends',
                   'friendsRequests',
            ));
    }

    public function addFriend($nickname)
    {
        $user = User::where('nickname', $nickname)->first();

        if (!$user){
            return redirect()->route('news.index')
                ->with('info','User not found');
        }

        if(Auth::user()->id === $user->id){
            return redirect()->route('news.index');
        }

        if( Auth::user()->hasFriendRequestPending($user)
          || $user->hasFriendRequestPending(Auth::user()) ) {
            return redirect()->route('user_profile.index',$user->nickname)
                ->with('info','Send friend request');
        }

        if (Auth::user()->isFriendWith($user)){
            return redirect()->route('user_profile.index',$user->nickname)
                ->with('info','User is already your friend ');
        }

        Auth::user()->addFriend($user);

        return redirect()->route('user_profile.index',$user->nickname)
            ->with('info','User got friend request');
    }

    public function acceptFriend($nickname)
    {
        $user = User::where('nickname', $nickname)->first();

        if (!$user) {
            return redirect()->route('news.index')
                ->with('info', 'User not found');
        }

        if (!Auth::user()->hasFriendRequestReceived($user)){
            return redirect()->route('news.index');
        }

        Auth::user()->acceptFriendRequest($user);

        return redirect()->route('user_profile.index',$user->nickname)
            ->with('info','Request has been approven');

    }
}
