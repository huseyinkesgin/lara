<?php

namespace App\Livewire\Contact;

use App\Models\Beos\Company;
use App\Livewire\BaseCreateLocation;
use Livewire\Attributes\On;
use App\Models\Beos\City;
use App\Models\Beos\District;
use App\Models\Beos\Town;
use App\Models\Beos\Neighborhood;


class CompanyCreate extends BaseCreateLocation
{
    public $code;
    public $name;
    public $tax_name;
    public $tax_office;
    public $tax_number;
    public $phone;
    public $email;
    public $mersis_number;
    public $kep_address;
    public $website;
    public $address;
    public $status;
    public $city_id;
    public $town_id;
    public $district_id;
    public $neighborhood_id;
    public $description;

    public $cities;
    public $towns = [];
    public $districts = [];
    public $neighborhoods = [];


    public function rules()
    {
        return [
                'code' => ['required', 'string', 'min:4', 'max:30', 'unique:companies'],
                'name' => 'required|string|min:3|max:30|unique:companies,name',
                'tax_name' => 'nullable|string|min:3|max:200',
                'tax_office' => ['nullable', 'string', 'min:3', 'max:60'],
                'tax_number' => ['nullable', 'string', 'min:13', 'max:13', 'unique:companies'],
                'phone' => ['nullable', 'string', 'min:15', 'max:15', 'unique:companies'],
                'email' => ['nullable', 'string', 'min:10', 'max:75', 'unique:companies'],
                'mersis_number' => ['nullable', 'string', 'min:16', 'max:16', 'unique:companies'],
                'kep_address' => ['nullable', 'string', 'min:11', 'max:45', 'unique:companies'],
                'website' => ['nullable', 'string', 'min:3', 'max:30', 'unique:companies'],
                'address' => ['nullable', 'string', 'min:15', 'max:255'],
                'status' => ['required'],
                'city_id' => ['required'],
                'town_id' => ['required'],
                'district_id' => ['required'],
                'neighborhood_id' => ['required'],
                'description' => ['nullable', 'string', 'max:255'],
            ];
    }

    public function messages()
    {
        return  [
            'code.unique' => 'Kod alanı benzersiz olmalıdır.',
            'code.min' => 'Kod alanı en az 4 karakter olmalıdır.',
            'code.max' => 'Kod alanı en fazla 30 karakter olmalıdır.',
            'code.required' => 'Kod alanı zorunludur.',
            'name.required' => 'Ad alanı zorunludur.',
            'name.min' => 'Ad alanı en az 3 karakter olmalıdır.',
            'name.max' => 'Ad alanı en fazla 30 karakter olmalıdır.',
            'name.unique' => 'Ad alanı benzersiz olmalıdır.',
            'is_active.boolean' => 'Aktif alanı doğru formatta değil.',
            'tax_name.max' => 'Vergi alanı en fazla 200 karakter olmalıdır.',
            'address.max' => 'Adres alanı en fazla 255 karakter olmalıdır.',
            'address.min' => 'Adres alanı en az 15 karakter olmalıdır.',
            'phone.max' => 'Telefon alanı en fazla 15 karakter olmalıdır.',
            'email.max' => 'Email alanı en fazla 75 karakter olmalıdır.',
            'mersis_number.max' => 'Mersis numarası alanı en fazla 16 karakter olmalıdır.',
            'kep_address.max' => 'Kep adresi alanı en fazla 45 karakter olmalıdır.',
            'website.max' => 'Website alanı en fazla 30 karakter olmalıdır.',
            'tax_name.max' => 'Vergi alanı en fazla 200 karakter olmalıdır.',
            'tax_office.max' => 'Vergi alanı en fazla 60 karakter olmalıdır.',
            'tax_number.max' => 'Vergi alanı en fazla 10 karakter olmalıdır.',
            'tax_number.min' => 'Vergi alanı en az 10 karakter olmalıdır.',
            'phone.min' => 'Telefon alanı en az 10 karakter olmalıdır.',
            'phone.max' => 'Telefon alanı en fazla 10 karakter olmalıdır.',
            'email.min' => 'Email alanı en az 10 karakter olmalıdır.',
            'email.max' => 'Email alanı en fazla 75 karakter olmalıdır.',
            'mersis_number.min' => 'Mersis numarası alanı en az 16 karakter olmalıdır.',
            'mersis_number.max' => 'Mersis numarası alanı en fazla 16 karakter olmalıdır.',
            'kep_address.min' => 'Kep adresi alanı en az 11 karakter olmalıdır.',
            'kep_address.max' => 'Kep adresi alanı en fazla 45 karakter olmalıdır.',
            'website.min' => 'Website alanı en az 3 karakter olmalıdır.',
            'website.max' => 'Website alanı en fazla 30 karakter olmalıdır.',
            'status.required' => 'Durum alanı zorunludur.',
            'city_id.required' => 'Seçilen seçim zorunludur.',
            'town_id.required' => 'Seçilen seçim zorunludur.',
            'district_id.required' => 'Seçilen seçim zorunludur.',
            'neighborhood_id.required' => 'Seçilen seçim zorunludur.',
            'description.max' => 'Açıklama alanı en fazla 255 karakter olmalıdır.',
        ];
    }


    #[On('openCreateModal')]
    public function openModal()
    {
        $this->open = true;
        $this->resetForm();
        $this->code = Company::generateNextCode('FİRMA', 4);
    }

    public function resetForm()
    {
        $this->reset('code', 'name', 'tax_name', 'tax_office', 'tax_number', 'phone', 'email', 'mersis_number', 'kep_address', 'website', 'city_id', 'town_id', 'district_id', 'neighborhood_id', 'address', 'description', 'status');
    }



    public function save()
    {
        try {
            $validatedData = $this->validate();
                any::create($validatedData);
            $this->open = false;
            $this->resetForm();
            $this->dispatch('company-created');
            
            // Başarı bildirimi
            $this->dispatch('swal', [
                'toast' => true,
                'icon' => 'success',
                'title' => 'Başarılı!',
                'text' => 'Şirket başarıyla kaydedildi.'
            ]);
        } catch (\Exception $e) {
            // Hata bildirimi
            $this->dispatch('swal', [
                'toast' => true,
                'icon' => 'error',
                'title' => 'Hata!',
                'text' => 'Şirket kaydedilirken bir hata oluştu: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.contact.company-create');
    }
}
