<?php

namespace App\Http\Controllers;
use App\Models\Friends;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FriendsController extends Controller
{
    public function index($nickname): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = User::where('nickname',$nickname)->first();
        $friends = Auth::user()->friends();
        $friendsRequests = Auth::user()->friendRequests();

        return view('profile.partials.friends',
            compact('friends',
                    'friendsRequests',
                             'user'
            ));
    }


    public function add($nickname): RedirectResponse
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
            || $user->hasFriendRequestPending(Auth::user()) )
        {
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

    public function accept($nickname)
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

    public function delete($nickname)
    {
        $user = User::where('nickname', $nickname)->first();

        if (!Auth::user()->isFriendWith($user)){
            return redirect()->back();
        }

        Auth::user()->deleteFriend($user);

        return redirect()->back()
            ->with('info',"User $user->nickname just have been deleted");
    }
}
