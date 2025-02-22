<?php

namespace App\Livewire\Location;

use Livewire\Component;
use Livewire\Attributes\Title;
class NeighborhoodIndex extends Component
{
    #[Title('Mahalle Listesi')]
    public function render()
    {
        return view('livewire.location.neighborhood-index');
    }
}
