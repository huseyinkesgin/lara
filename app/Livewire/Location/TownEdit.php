<?php

namespace App\Livewire\Location;

use Livewire\Component;
use App\Models\Beos\City;   
use App\Models\Beos\Town;
use Livewire\Attributes\On;

class TownEdit extends Component
{
    public $code;
    public $city_id;
    public $name;
    public $is_active;
    public $description;
    public $townId;

    public $open = false;

     public function rules()
    {
    return [
        'code' => "required|string|min:4|max:30",  
        'city_id' => "required|integer",  
        'name' => "required|string|min:3|max:30",
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
            'city_id.required' => 'Sehir alanı zorunludur.',
            'name.required' => 'Ad alanı zorunludur.',
            'name.min' => 'Ad alanı en az 3 karakter olmalıdır.',
            'name.max' => 'Ad alanı en fazla 30 karakter olmalıdır.',
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
        $this->setTowns($id);
        $this->open = true;
    }

    public function setTowns($id)
    {
        $town = Town::find($id);

        $this->townId = $town->id;
        $this->code = $town->code;
        $this->city_id = $town->city_id;
        $this->name = $town->name;
        $this->is_active = $town->is_active;
        $this->description = $town->description;
    }

    public function resetForm()
{
    $this->reset(['code', 'city_id', 'name', 'description', 'is_active']);

}

    public function save()
    {
        $validatedData = $this->validate();

        try {
            $town = Town::findOrFail($this->townId);
            $town->update($validatedData);

            $this->dispatch('town-updated');
            $this->open = false;
            $this->resetForm();
            $this->dispatch('swal', [
                'toast' => true,
                'icon' => 'success',
                'title' => 'Başarılı!',
                'text' => 'İlçe başarıyla güncellendi.'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('swal', [
                'toast' => true,
                'icon' => 'error',
                'title' => 'Hata!',
                'text' => 'İlçe güncelenirken bir hata oluştu: ' . $e->getMessage()
            ]);
        }
    }

    
    public function render()
    {
        $cities = City::all();
        return view('livewire.location.town-edit', compact('cities'));
    }
}
