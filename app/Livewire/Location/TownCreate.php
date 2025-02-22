<?php

namespace App\Livewire\Location;

use Livewire\Component;
use App\Models\Beos\City;
use App\Models\Beos\Town;
use App\Livewire\BaseCreate;
use Livewire\Attributes\On;


class TownCreate extends BaseCreate
{
    public $code;
    public $city_id;
    public $name;
    public $is_active = "1";
    public $description;

    public function rules()
    {
    return [
        'code' => ['required', 'string', 'min:4', 'max:30'],
        'city_id' => ['required', 'integer', 'exists:cities,id'],
        'name' => ['required', 'string', 'min:3', 'max:30'],
        'is_active' => ['required'],
        'description' => ['nullable', 'string', 'min:10','max:255'],
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
            'is_active.required' => 'Aktif alanı zorunludur.',
            'description.min' => 'Açıklama alanı en az 10 karakter olmalıdır.',
            'description.max' => 'Açıklama alanı en fazla 255 karakter olmalıdır.',
        ];
    }

    #[On('openCreateModal')]
    public function openModal()
    {
        $this->open = true;
        $this->resetForm();
        $this->code = Town::generateNextCode('ILCE', 2);
    }

    public function resetForm()
    {
        $this->reset('code', 'city_id', 'name', 'description');
    }

    public function save()
    {
        try {
            $validatedData = $this->validate();
            Town::create($validatedData);
            $this->open = false;
            $this->resetForm();
            $this->dispatch('town-created');
            
            // Başarı bildirimi
            $this->dispatch('swal', [
                'toast' => true,
                'icon' => 'success',
                'title' => 'Başarılı!',
                'text' => 'İlçe başarıyla kaydedildi.'
            ]);
        } catch (\Exception $e) {
            // Hata bildirimi
            $this->dispatch('swal', [
                'toast' => true,
                'icon' => 'error',
                'title' => 'Hata!',
                'text' => 'İlçe kaydedilirken bir hata oluştu: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        $cities = City::all();
        return view('livewire.location.town-create', compact('cities'));
    }
}
