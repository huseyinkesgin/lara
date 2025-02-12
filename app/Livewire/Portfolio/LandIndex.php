<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;
use Livewire\Attributes\Title;

class LandIndex extends Component
{
    #[Title('Arsa Listesi')]
    public function render()
    {
        return view('livewire.portfolio.land-index');
    }
}
