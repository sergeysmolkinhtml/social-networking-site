<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Friend extends Component
{
    public $user;

    public function mount($user)
    {
        $this->user = $user;
    }


    public function friendRequest($id)
    {
    dd($id);
    }

    public function render()
    {
        return view('livewire.friend');
    }
}
