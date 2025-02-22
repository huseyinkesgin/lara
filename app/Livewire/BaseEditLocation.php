<?php

namespace App\Livewire;

use App\Models\Beos\City;
use App\Models\Beos\District;
use App\Models\Beos\Neighborhood;
use App\Models\Beos\Town;
use Livewire\Component;

class BaseEditLocation extends Component
{
    public $open = false;


    public function mount()
    {
        $this->cities = City::active()->get();

    }
    public function updatedCityId($value)
    {
        $this->city_id = $value;

        $this->towns = Town::where('city_id', $value)->get();
        $this->town_id = null;
        $this->districts = [];
        $this->district_id = null;
        $this->neighborhoods = [];
        $this->neighborhood_id = null;
    }

    public function updatedTownId($value)
    {
        $this->town_id = $value;
        $this->districts = District::where('town_id', $value)->get();
        $this->district_id = null;
        $this->neighborhoods = [];
        $this->neighborhood_id = null;
    }

    public function updatedDistrictId($value)
    {
        $this->district_id = $value;
        $this->neighborhoods = Neighborhood::where('district_id', $value)->get();
        $this->neighborhood_id = null;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.base-edit-location');
    }
}
