<?php

namespace App\Livewire\Location;

use Livewire\Component;
use App\Models\Beos\City;
use App\Models\Beos\Town;
use App\Models\Beos\District;
use App\Models\Beos\Neighborhood;
use Livewire\Attributes\On;

class NeighborhoodCreate extends Component
{
    public $open = false;

    public $code;
    public $city_id;
    public $town_id;
    public $district_id;
    public $name;
    public $is_active = true;
    public $description;

    public $cities;
    public $towns = [];
    public $districts = [];

    public function rules()
    {
        return [
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'town_id' => ['required', 'integer', 'exists:towns,id'],
            'district_id' => ['required', 'integer', 'exists:districts,id'],
            'code' => ['required', 'string', 'min:4', 'max:30'],
            'name' => ['required', 'string', 'min:3', 'max:30'],
            'is_active' => ['required'],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'city_id.required' => 'İl alanı zorunludur.',
            'city_id.integer' => 'İl alanı sayısal bir değer olmalıdır.',
            'city_id.exists' => 'İl alanı geçersiz bir değerdir.',
            'town_id.required' => 'İlçe alanı zorunludur.',
            'town_id.integer' => 'İlçe alanı sayısal bir değer olmalıdır.',
            'town_id.exists' => 'İlçe alanı geçersiz bir değerdir.',
            'district_id.required' => 'Semt alanı zorunludur.',
            'district_id.integer' => 'Semt alanı sayısal bir değer olmalıdır.',
            'district_id.exists' => 'Semt alanı geçersiz bir değerdir.',
            'code.required' => 'Kod alanı zorunludur.',
            'code.min' => 'Kod alanı en az 4 karakter olmalıdır.',
            'code.max' => 'Kod alanı en fazla 30 karakter olmalıdır.',
            'name.required' => 'Ad alanı zorunludur.',
            'name.min' => 'Ad alanı en az 3 karakter olmalıdır.',
            'name.max' => 'Ad alanı en fazla 30 karakter olmalıdır.',
            'is_active.required' => 'Durum alanı zorunludur.',
            'description.max' => 'Açıklama alanı en fazla 255 karakter olmalıdır.',
        ];
    }

    public function mount()
    {
        $this->cities = City::active()->orderBy('name')->get();
    }

    public function updatedCityId($value)
    {
        if ($value) {
            $this->towns = Town::where('city_id', $value)->orderBy('name')->get();
            $this->town_id = null;
            $this->district_id = null;
            $this->districts = [];
        } else {
            $this->towns = [];
            $this->town_id = null;
            $this->district_id = null;
            $this->districts = [];
        }
    }

    public function updatedTownId($value)
    {
        if ($value) {
            $this->districts = District::where('town_id', $value)->orderBy('name')->get();
            $this->district_id = null;
        } else {
            $this->districts = [];
            $this->district_id = null;
        }
    }

    #[On('openCreateModal')]
    public function openModal()
    {
        $this->open = true;
        $this->resetForm();
        $this->code = Neighborhood::generateNextCode('MHL', 2);
    }

    public function resetForm()
    {
        $this->reset(['code', 'name', 'description', 'city_id', 'town_id', 'district_id']);
        $this->towns = [];
        $this->districts = [];
    }

    public function save()
    {
        try {
            $validatedData = $this->validate();
            Neighborhood::create($validatedData);
            
            $this->dispatch('neighborhood-created');
            $this->open = false;
            $this->resetForm();

            $this->dispatch('swal', [
                'toast' => true,
                'icon' => 'success',
                'title' => 'Başarılı!',
                'text' => 'Mahalle başarıyla kaydedildi.'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('swal', [
                'toast' => true,
                'icon' => 'error',
                'title' => 'Hata!',
                'text' => 'Mahalle kaydedilirken bir hata oluştu: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.location.neighborhood-create');
    }
}
