<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Component;

class Form extends Component
{
    public $email;
    public $message;
    public $phone;

    public function submit(): void
    {
        $this->validate([
            'email' => 'nullable|email',
            'message' => 'required|min:10',
            'phone' => 'nullable'
        ]);

        $message = new Message();
        $message->email = $this->email;
        $message->phone = $this->phone;
        $message->message = $this->message;
        $message->save();

        session()->flash('status', 'Message received.');


        $this->reset();

    }

    public function render()
    {
        return view('livewire.form');
    }
}
