<?php

namespace App\Livewire\Location;

use Livewire\Component;
use App\Models\Neighbourhood;
use Livewire\Attributes\On;
use App\Livewire\BaseTable;

class NeighbourhoodTable extends BaseTable
{

    #[On('neighbourhood-created')]
    #[On('neighbourhood-updated')]
    #[On('neighbourhood-deleted')]
    public function render()
    {
        $data = Neighbourhood::search($this->search)->paginate($this->perPage);
        return view('livewire.location.neighbourhood-table',[
            'data' => $data
        ]);
    }

}
