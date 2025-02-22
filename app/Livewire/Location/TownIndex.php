<?php

namespace App\Livewire\Location;

use Livewire\Component;

class TownIndex extends Component
{
    #[Title('İlçeler')]
    public function render()
    {
        return view('livewire.location.town-index');
    }
}
