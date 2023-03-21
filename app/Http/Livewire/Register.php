<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Laravel\Jetstream\Jetstream;
use App\Actions\Fortify\PasswordValidationRules;

class Register extends Component
{
    use PasswordValidationRules;

    public $currentStep = 0;

    public $name, $last_name, $gender,$terms;
    public $nickname, $email, $password, $password_confirmation;


    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.register');
    }

    public function nextStep()
    {
        $this->validate([
           'name'      => 'required|string|min:3|max:50',
           'last_name' => 'required|string|min:3',
           'gender'    => 'required|string|regex:/^[mf]$/',
        ]);

        $this->currentStep++;
    }


    public function submitForm()
    {
        $this->validate([
            'nickname' => 'required|min:3|max:50|unique:users',
            'email'    => 'required|email|unique:users',
            'password' =>  $this->passwordRules(),
            'terms'    =>  Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ]);

        User::create([
            'name'     =>  $this->name,
            'last_name'=>  $this->last_name,
            'gender'   =>  $this->gender,
            'nickname' =>  $this->nickname,
            'email'    =>  $this->email,
            'password' =>  Hash::make($this->password),
        ]);

        # Log In after registration

        if (Auth::attempt(['nickname' => $this->nickname,
                           'password' => $this->password,]))
        {
            return redirect()->route('dashboard'); // intended
        }
    }

    public function back()
    {
        $this->currentStep-- ;
    }

}
