<?php

namespace App\Livewire;

use App\Models\Grade;
use Livewire\Component;

class Header extends Component
{
    public $classes;

    public function mount(): void
    {
        $this->classes = Grade::all();

    }
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.header');
    }
}
