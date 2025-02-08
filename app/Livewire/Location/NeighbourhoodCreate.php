<?php

namespace App\Livewire\Location;

use App\Models\City;
use Livewire\Component;
use App\Models\District;
use Livewire\Attributes\On;
use App\Models\Neighbourhood;

class NeighbourhoodCreate extends Component
{
    public $open = false;

    public $code;
    public $city_id;
    public $district_id;
    public $name;
    public $is_active = true;
    public $description;
    public $cities;
    public $districts = [];


    protected function rules()
    {
    return [
        'city_id' => ['required', 'integer', 'exists:cities,id'],
        'district_id' => ['required', 'integer', 'exists:districts,id'],
        'code' => ['required', 'string', 'min:4', 'max:30', 'unique:neighbourhoods'],
        'name' => ['required', 'string', 'min:3', 'max:30', 'unique:neighbourhoods'],
        'is_active' => ['boolean'],
        'description' => ['nullable', 'string', 'max:255'],
    ];
    }

    protected function messages()
    {
        return [
            'city_id.required' => 'Şehir alanı zorunludur.',
            'city_id.integer' => 'Şehir alanı sayısal bir değer olmalıdır.',
            'city_id.exists' => 'Şehir alanı geçersiz bir değerdir.',
            'district_id.required' => 'İlçe alanı zorunludur.',
            'district_id.integer' => 'İlçe alanı sayısal bir değer olmalıdır.',
            'district_id.exists' => 'İlçe alanı geçersiz bir değerdir.',
            'code.required' => 'Kod alanı zorunludur.',
            'code.min' => 'Kod alanı en az 4 karakter olmalıdır.',
            'code.max' => 'Kod alanı en fazla 30 karakter olmalıdır.',
            'code.unique' => 'Kod alanı benzersiz olmalıdır.',
            'name.required' => 'Ad alanı zorunludur.',
            'name.min' => 'Ad alanı en az 3 karakter olmalıdır.',
            'name.max' => 'Ad alanı en fazla 30 karakter olmalıdır.',
            'name.unique' => 'Ad alanı benzersiz olmalıdır.',
            'is_active.boolean' => 'Aktif alanı doğru formatta değil.',
            'description.max' => 'Açıklama alanı en fazla 255 karakter olmalıdır.',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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

    #[On('openCreateModal')]
    public function openModal()
    {
        $this->open = true;
        $this->resetForm();
        $this->code = Neighbourhood::generateNextCode('MAH', 4);
    }

    public function resetForm()
    {
        $this->reset('code', 'name', 'description', 'city_id', 'district_id');
    }


    public function save()
    {
       $validatedData = $this->validate();

        try {
        \App\Models\Neighbourhood::create($validatedData);
        $this->open = false;
        $this->resetForm();
        $this->dispatch('neighbourhood-created');
        } catch (\Exception $e) {
            session()->flash('error', 'Mahalle kaydedilirken bir hata oluştu.');
        }
    }


    public function render()
    {
        return view('livewire.location.neighbourhood-create');
    }
}
