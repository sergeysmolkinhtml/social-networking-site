<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class UpdateAbout extends Component
{

    /**
     * The component's state.
     *
     * @var array
     */
    public array $state = [];

    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->toArray();
    }

    /**
     * @throws ValidationException
     */
    public function updateAbout()
    {
        Validator::make($this->state,[
            'status_description' => "max:150"
        ])->validate();

        $user = Auth::user();

        $user->update([

            'status_description' => $this->state['status_description']

            ]);

        $this->emit('saved');
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.update-about');
    }
}
