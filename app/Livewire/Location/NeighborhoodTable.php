<?php

namespace App\Livewire\Location;

use Livewire\Component;
use App\Models\Beos\Neighborhood;
use Livewire\Attributes\On;
use App\Livewire\BaseTable;

class NeighborhoodTable extends BaseTable
{
    public $neighborhoodCount;

    #[On('neighborhood-created')]
    #[On('neighborhood-updated')]
    #[On('neighborhood-deleted')]
    public function render()
    {
        $this->neighborhoodCount = Neighborhood::count();

        $data = Neighborhood::with(['district.town.city'])
            ->search($this->search)
            ->paginate($this->perPage);

        return view('livewire.location.neighborhood-table', [
            'data' => $data,
            'neighborhoodCount' => $this->neighborhoodCount
        ]);
    }
}
