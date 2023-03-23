<?php

namespace App\Http\Livewire\Pages;

use App\Models\User;
use Livewire\Component;

class CandidateProfile extends Component
{
    public function render($user)
    {
        return view('livewire.pages.candidate-profile',[

            'user' => User::where('id',$user->id)->firstOrFail()

        ]);
    }
}
