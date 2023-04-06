<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ChangeUserRoleService
{

    public function change($userID): RedirectResponse
    {
        $user = User::where('id', $userID)->first();

        if ($user->isEmployer($user)) {
            $user->update(['employer' => 0]);
            return redirect()->back()->with('info', 'Changed to candidate profile');

        } else {
            $user->update(['employer' => 1]);
        }

        return redirect()->back()->with('info', 'Changed to employers profile');
    }
}
