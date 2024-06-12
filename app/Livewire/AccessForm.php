<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;

class AccessForm extends Component
{
    public $password;
    public $name;


    public function submit()
    {
        $this->validate([
            'password' => 'required',
            'name' => 'required'
        ]);

        $user = Student::where('name', $this->name)->first();

        if ($user && password_verify($this->password, $user->password)) {
            session()->put('user', $user);
            return redirect()->route('classes');
        }

        session()->flash('error', 'Access Not Granted');

    }

    public function render()
    {
        return view('livewire.access-form');
    }


}
