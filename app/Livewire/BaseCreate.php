<?php

namespace App\Livewire;

use Livewire\Component;

class BaseCreate extends Component
{
    public $open = false;





    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.base-create');
    }
}
