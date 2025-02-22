<?php

namespace App\Livewire\Location;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Beos\District;
use App\Models\Beos\Town;
use App\Models\Beos\City;

class DistrictEdit extends Component
{
    public $districtId;
    public $code;
    public $city_id;
    public $town_id;
    public $name;
    public $is_active;
    public $description;

    public $cities;
    public $towns = [];
    public $open = false;

    public function rules()
    {
        return [
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'town_id' => ['required', 'integer', 'exists:towns,id'],
            'code' => "required|string|min:4|max:30",
            'name' => "required|string|min:3|max:30",
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
            'code.required' => 'Kod alanı zorunludur.',
            'code.min' => 'Kod alanı en az 4 karakter olmalıdır.',
            'code.max' => 'Kod alanı en fazla 30 karakter olmalıdır.',
            'name.required' => 'Ad alanı zorunludur.',
            'name.min' => 'Ad alanı en az 3 karakter olmalıdır.',
            'name.max' => 'Ad alanı en fazla 30 karakter olmalıdır.',
            'is_active.required' => 'Aktif alanı zorunludur.',
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
        } else {
            $this->towns = [];
            $this->town_id = null;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->resetForm();
        $this->open = true;

        $district = District::with('town.city')->find($id);

        $this->districtId = $district->id;
        $this->city_id = $district->town->city_id;
        $this->towns = Town::where('city_id', $this->city_id)->orderBy('name')->get();
        $this->town_id = $district->town_id;
        $this->code = $district->code;
        $this->name = $district->name;
        $this->is_active = $district->is_active;
        $this->description = $district->description;
    }

    public function resetForm()
    {
        $this->reset(['code', 'name', 'description', 'city_id', 'town_id', 'is_active']);
        $this->towns = [];
    }

    public function save()
    {
        try {
            $district = District::findOrFail($this->districtId);
            $district->update($this->validate());

            $this->dispatch('district-updated');
            $this->open = false;
            $this->resetForm();
            $this->dispatch('swal', [
                'toast' => true,
                'icon' => 'success',
                'title' => 'Başarılı!',
                'text' => 'Semt başarıyla güncellendi.'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('swal', [
                'toast' => true,
                'icon' => 'error',
                'title' => 'Hata!',
                'text' => 'Semt güncelenirken bir hata oluştu: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.location.district-edit');
    }
}
