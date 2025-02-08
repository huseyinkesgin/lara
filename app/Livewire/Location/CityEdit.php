<?php

namespace App\Livewire\Location;

use App\Models\City;
use Livewire\Component;
use Livewire\Attributes\On;

class CityEdit extends Component
{
    public $code;
    public $name;
    public $is_active;
    public $description;
    public $cityId;

    public $open = false;

     public function rules()
    {
    return [
                'code' => "required|string|min:4|max:30|unique:cities,code,{$this->cityId}",
        'name' => "required|string|min:3|max:30|unique:cities,name,{$this->cityId}",
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

    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->setCities($id);
        $this->open = true;
    }

    public function setCities($id)
    {
        $city = City::find($id);

        $this->cityId = $city->id;
        $this->code = $city->code;
        $this->name = $city->name;
        $this->is_active = $city->is_active;
        $this->description = $city->description;
    }

    public function resetForm()
{
    $this->reset(['code', 'name', 'description', 'is_active']);

}

    public function save()
    {
        $validatedData = $this->validate();
           try {


        $city = City::findOrFail($this->cityId);
        $city->update($validatedData);

        $this->dispatch('city-updated');
        $this->open = false;
        $this->resetForm();

        session()->flash('message', 'Şehir başarıyla güncellendi.');
    } catch (\Exception $e) {
        session()->flash('error', 'Güncelleme sırasında bir hata oluştu: ' . $e->getMessage());
    }



    }


    public function render()
    {
        return view('livewire.location.city-edit');
    }
}
