<?php

namespace App\Livewire\Location;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Neighbourhood;

class NeighbourhoodDelete extends Component
{
    public $open = false;
    public $neighbourhoodId;
   
    #[On('openDeleteModal')]
    public function openModal($id)
    {
        $this->open = true;
        $this->neighbourhoodId = $id['id'] ?? $id;
    }

    public function delete()
    {
        if ($this->neighbourhoodId) {
            Neighbourhood::destroy($this->neighbourhoodId);
            $this->dispatch('neighbourhood-deleted');
            $this->open = false;
        }
    }


    public function render()
    {
        return view('livewire.location.neighbourhood-delete');
    }
}
