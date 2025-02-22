<?php

namespace App\Livewire\Location;

use Livewire\Component;
use App\Models\Beos\City;
use App\Models\Beos\Town;
use App\Models\Beos\District;
use App\Models\Beos\Neighborhood;
use App\Livewire\BaseTable;

class TownTable extends BaseTable
{

    public $townCount;
    public $districtCount;
    public $neighborhoodCount;



    #[On('town-created')]
    #[On('town-updated')]
    #[On('town-deleted')]
    public function render()
    {

      
        $this->townCount = Town::count();
        $this->districtCount = District::count();
        $this->neighborhoodCount = Neighborhood::count();

        $data = Town::search($this->search)->paginate($this->perPage);
        return view('livewire.location.town-table',[
            'data' => $data,
            'townCount' => $this->townCount,
            'districtCount' => $this->districtCount,
            'neighborhoodCount' => $this->neighborhoodCount
        ]);
    
    }
}
