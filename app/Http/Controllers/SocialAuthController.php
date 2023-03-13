<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginWithGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();
            $isUser = User::where('google_id',$user->id)->first();


            if($isUser){
                Auth::login($isUser);

                return redirect('/dashboart');
            }else{
                $createdUser = User::create([
                    'name'      => $user->name,
                    'email'     => $user->email,
                    'google_id' => $user->id,
                    'password'  => encrypt('user'),
                ]);
                Auth::login($createdUser);

                return redirect('/dashboard');
            }
        } catch (\Exception $exception){
            dd($exception->getMessage());
        }



    }

}
