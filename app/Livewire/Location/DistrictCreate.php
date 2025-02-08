<?php

namespace App\Livewire\Location;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\City;
use App\Models\District;
use App\Traits\GeneratesCode;

class DistrictCreate extends Component
{
    public $open = false;

    public $code;
    public $city_id;
    public $name;
    public $is_active = true;
    public $description;
    public $cities;
    public function rules()
    {
    return [
        'city_id' => ['required', 'integer', 'exists:cities,id'],
        'code' => ['required', 'string', 'min:4', 'max:30', 'unique:districts'],
        'name' => ['required', 'string', 'min:3', 'max:30', 'unique:districts'],
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

    #[On('openCreateModal')]
    public function openModal()
    {
        $this->open = true;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset('code', 'name', 'description', 'city_id');
        $this->code = District::generateNextCode('İLÇE', 3);
    }



    public function save()
    {
       $validatedData = $this->validate();

        try {
      District::create($validatedData);
        $this->open = false;
        $this->resetForm();
        $this->dispatch('district-created');
        } catch (\Exception $e) {
            session()->flash('error', 'İlçe kaydedilirken bir hata oluştu.');
        }
    }


    public function render()
    {
        return view('livewire.location.district-create');
    }
}
