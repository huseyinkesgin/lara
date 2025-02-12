<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\District;
use App\Models\Neighbourhood;
use Livewire\Component;

class BaseCreateLocation extends Component
{

    public $open = false;

    public $code;
    public $description;
    public $city_id;
    public $district_id;
    public $neighbourhood_id;
    public $cities;
    public $districts = [];
    public $neighbourhoods = [];

    protected function baseRules()
    {
        return [
            'city_id' => 'nullable',
            'district_id' => 'nullable',
            'neighbourhood_id' => 'nullable',
            'code' => ['required', 'string', 'min:4', 'max:30', ],
             'description' => ['nullable', 'string', 'max:255'],
        ];
    }

    protected function baseMessages()
    {
        return [
            'code.required' => 'Kod alanı zorunludur.',
            'code.min' => 'Kod alanı en az 4 karakter olmalıdır.',
            'code.max' => 'Kod alanı en fazla 30 karakter olmalıdır.',
            'description.max' => 'Açıklama alanı en fazla 255 karakter olmalıdır.',
        ];
    }

    public function rules()
    {
        return $this->baseRules();
    }

    public function messages()
    {
        return $this->baseMessages();
    }

    public function mount()
    {
        $this->cities = City::active()->get();

    }
    public function updatedCityId($value)
    {
        $this->city_id = $value;
        $this->districts = District::where('city_id', $value)->get();
        $this->district_id = null;
    }

    public function updatedDistrictId($value)
    {
        $this->district_id = $value;
        $this->neighbourhoods = Neighbourhood::where('district_id', $value)->get();
        $this->neighbourhood_id = null;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.base-create-location');
    }
}

