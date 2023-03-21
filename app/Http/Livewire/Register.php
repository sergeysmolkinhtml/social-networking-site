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

    public $currentStep = 1;

    public $name, $last_name, $gender,$terms;
    public $nickname, $email, $password, $password_confirmation;


    public function render()
    {
        return view('livewire.register');
    }

    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
           'name' => 'required',
           'last_name' => 'required',

        ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'nickname' => 'required',
            'email'    => 'required',
            'password' =>  $this->passwordRules(),
            'terms'    => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ]);

    }

    public function submitForm()
    {
        User::create([
            'name'     =>  $this->name,
            'last_name'=>  $this->last_name,
            'gender'   =>  $this->gender,
            'nickname' =>  $this->nickname,
            'email'    =>  $this->email,
            'password' =>  Hash::make($this->password),
        ]);

        # Log In after registration

        if (Auth::attempt([
            'nickname' => $this->nickname,
            'password' => $this->password,
            ])) {

            return redirect()->intended('dashboard');
        }
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

}
