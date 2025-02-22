<?php

namespace App\Livewire\Location;

use notify;
use App\Enums\IsActive;
use App\Models\Beos\City;
use Livewire\Attributes\On;
use App\Livewire\BaseCreate;

class CityCreate extends BaseCreate
{


    public $code;
    public $name;
    public $is_active = "1";
    public $description;

    public function rules()
    {
    return [
        'code' => ['required', 'string', 'min:4', 'max:30', 'unique:cities'],
        'name' => ['required', 'string', 'min:3', 'max:30', 'unique:cities'],
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
            'code.unique' => 'Kod alanı benzersiz olmalıdır.',
            'name.required' => 'Ad alanı zorunludur.',
            'name.min' => 'Ad alanı en az 3 karakter olmalıdır.',
            'name.max' => 'Ad alanı en fazla 30 karakter olmalıdır.',
            'name.unique' => 'Ad alanı benzersiz olmalıdır.',
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
        $this->code = City::generateNextCode('IL', 2);
    }

    public function resetForm()
    {
        $this->reset('code', 'name', 'description');
    }

    public function save()
    {
        try {
            $validatedData = $this->validate();
            City::create($validatedData);
            $this->open = false;
            $this->resetForm();
            $this->dispatch('city-created');
            
            // Başarı bildirimi
            $this->dispatch('swal', [
                'toast' => true,
                'icon' => 'success',
                'title' => 'Başarılı!',
                'text' => 'Şehir başarıyla kaydedildi.'
            ]);
        } catch (\Exception $e) {
            // Hata bildirimi
            $this->dispatch('swal', [
                'toast' => true,
                'icon' => 'error',
                'title' => 'Hata!',
                'text' => 'Şehir kaydedilirken bir hata oluştu: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.location.city-create');
    }
}
