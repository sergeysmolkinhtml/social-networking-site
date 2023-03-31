<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;

class ExtendedProfile extends Component
{

    /**
     * The component's state.
     *
     * @var array
     */
    public array $state = [];

    /**
     * @var string[]
     */
    private array $birthdayArr;

    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->toArray();

        if(Auth::user()->date_of_birth){

            $this->birthdayArr = explode("-",Auth::user()->date_of_birth);
            $this->state['bday']   = substr($this->birthdayArr[2],0,2);
            $this->state['bmonth'] = $this->birthdayArr[1];
            $this->state['byear']  = $this->birthdayArr[0];

        } else {
            $this->state['bday']      = '';
            $this->state['bmonth']    = '';
            $this->state['byear']     = '';

        }

    }

    public function setStrBirthday()
    {
        if(($this->state['bday'] && $this->state['bmonth']
            && $this->state['byear']) != '')
        {
            return "{$this->state['byear']}-{$this->state['bmonth']}-{$this->state['bday']}";
        }
    }

    /**
     * @throws ValidationException
     */
    public function updateExtendedProfile()
    {
        Validator::make($this->state,[
            'byear'        => ['nullable','digits:4','integer'],
            'job_title'    => ['nullable','string','max:50'],
            'city'         => ['nullable','string','max:50'],
            'work_formats' => ['nullable','string','max:50'],
            'languages'    => ['nullable','string','max:200'],
            'skills'       => ['nullable','string','max:200'],
        ])->validate();

        $user = Auth::user();

        $user->update([
            'date_of_birth' => $this->setStrBirthday(),
            'job_title' => $this->state['job_title'],
            'city'      => $this->state['city'],
            'work_formats'=> $this->state['work_formats'],
            'languages'  => $this->state['languages'],
            'skills'    => $this->state['skills'],
            'achievements' => $this->state['achievements'],
        ]);


        $this->emit('saved');
    }


    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.extended-profile');
    }
}
