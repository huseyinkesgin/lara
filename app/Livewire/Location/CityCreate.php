<?php

namespace App\Livewire\Location;

use App\Models\City;
use Livewire\Component;
use Livewire\Attributes\On;

class CityCreate extends Component
{

    public $open = false;

    public $code;
    public $name;
    public $is_active = true;
    public $description;

    public function rules()
    {
    return [
        'code' => ['required', 'string', 'min:4', 'max:30', 'unique:cities'],
        'name' => ['required', 'string', 'min:3', 'max:30', 'unique:cities'],
        'is_active' => ['boolean'],
        'description' => ['nullable', 'string', 'max:255'],
    ];
    }

    public function messages()
    {
        return [
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

    #[On('openCreateModal')]
    public function openModal()
    {
        $this->open = true;
        $this->resetForm();
        $this->code = City::generateNextCode('IL', 2);
    }

    public function resetForm()
    {
        $this->reset('code', 'name', 'description');
    }

    public function save()
    {
       $validatedData = $this->validate();

        try {
        \App\Models\City::create($validatedData);
        $this->open = false;
        $this->resetForm();
        $this->dispatch('city-created'); // Fixed typo: dispacth -> dispatch
    } catch (\Exception $e) {
        session()->flash('error', 'Şehir kaydedilirken bir hata oluştu.');
    }
    }

    public function render()
    {
        return view('livewire.location.city-create');
    }
}
