<?php

namespace App\Livewire\Location;

use Livewire\Component;
use Livewire\Attributes\Title;

class DistrictIndex extends Component
{
    #[Title('İlçeler')]
    public function render()
    {
        return view('livewire.location.district-index');
    }
}
