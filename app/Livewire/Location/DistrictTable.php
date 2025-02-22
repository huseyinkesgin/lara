<?php

namespace App\Livewire\Location;

use Livewire\Component;
use App\Models\Beos\District;
use Livewire\Attributes\On;
use App\Livewire\BaseTable;
use App\Models\Beos\Neighborhood;
use App\Models\Beos\Town;

class DistrictTable extends BaseTable
{
    public $districtCount;
    public $neighborhoodCount;

    #[On('district-created')]
    #[On('district-updated')]
    #[On('district-deleted')]
    public function render()
    {
        $this->districtCount = District::count();
        $this->neighborhoodCount = Neighborhood::count();

        $data = District::search($this->search)->paginate($this->perPage);
        return view('livewire.location.district-table',[
            'data' => $data,
            'districtCount' => $this->districtCount,
            'neighborhoodCount' => $this->neighborhoodCount
        ]);
    }

}
