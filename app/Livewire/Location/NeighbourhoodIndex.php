<?php

namespace App\Livewire\Location;

use Livewire\Component;
use Livewire\Attributes\Title;
class NeighbourhoodIndex extends Component
{
    #[Title('Mahalle Listesi')]
    public function render()
    {
        return view('livewire.location.neighbourhood-index');
    }
}
