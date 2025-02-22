<?php

namespace App\Livewire\Location;

use App\Models\Beos\City;
use App\Livewire\BaseTable;
use App\Models\Beos\Town;
use App\Models\Beos\District;
use App\Models\Beos\Neighborhood;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CityTable extends BaseTable
{
    public $cityCount;
    public $townCount;
    public $districtCount;
    public $neighborhoodCount;



    #[On('city-created')]
    #[On('city-updated')]
    #[On('city-deleted')]
    public function render()
    {

      
        $this->cityCount = City::count();
        $this->townCount = Town::count();
        $this->districtCount = District::count();
        $this->neighborhoodCount = Neighborhood::count();

        $data = City::search($this->search)->paginate($this->perPage);
        return view('livewire.location.city-table',[
            'data' => $data,
            'cityCount' => $this->cityCount,
            'townCount' => $this->townCount,
            'districtCount' => $this->districtCount,
            'neighborhoodCount' => $this->neighborhoodCount
        ]);
    
    }
}
