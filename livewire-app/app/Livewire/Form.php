<?php

namespace App\Livewire;

use Livewire\Component;

class Form extends Component
{
    public $name = "";
    
    public function render()
    {
        return view('livewire.form');
    }
}
