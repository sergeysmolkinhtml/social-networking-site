<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Employer extends Component
{
    public $user;

    public function mount($user)
    {
        return $this->user;
    }

    public function employerRequest($id)
    {

    }


    public function render()
    {
        return view('livewire.employer');
    }
}
