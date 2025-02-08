<?php

namespace App\Livewire\Location;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\District;
use App\Models\City;
class DistrictEdit extends Component
{
    public $code;
    public $city_id;
    public $name;
    public $is_active;
    public $description;
    public $districtId;

    public $cities;
    public $open = false;

     public function rules()
    {
    return [
        'city_id' => ['required', 'integer', 'exists:cities,id'],
        'code' => "required|string|min:4|max:30|unique:districts,code,{$this->districtId}",
        'name' => "required|string|min:3|max:30|unique:districts,name,{$this->districtId}",
        'is_active' => ['boolean'],
        'description' => ['nullable', 'string', 'max:255'],
    ];
    }

    public function messages()
    {
        return [
            'city_id.required' => 'Şehir alanı zorunludur.',
            'city_id.integer' => 'Şehir alanı sayısal bir değer olmalıdır.',
            'city_id.exists' => 'Şehir alanı geçersiz bir değerdir.',
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

    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->setDistricts($id);
        $this->open = true;
    }

    public function setDistricts($id)
    {
        $district = District::find($id);

        $this->districtId = $district->id;
        $this->city_id = $district->city_id;
        $this->code = $district->code;
        $this->name = $district->name;
        $this->is_active = $district->is_active;
        $this->description = $district->description;
    }

    public function resetForm()
    {
        $this->reset(['code', 'name', 'description', 'city_id']);

    }

    public function save()
    {
        $validatedData = $this->validate();
           try {


        $district = District::findOrFail($this->districtId);
        $district->update($validatedData);

        $this->dispatch('district-updated');
        $this->open = false;
        $this->resetForm();

        session()->flash('message', 'İlçe başarıyla güncellendi.');
        } catch (\Exception $e) {
            session()->flash('error', 'Güncelleme sırasında bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function render()
    {

        return view('livewire.location.district-edit');
    }
}
