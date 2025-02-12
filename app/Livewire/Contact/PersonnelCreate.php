<?php

namespace App\Livewire\Contact;

use Carbon\Carbon;
use App\Models\Company;
use App\Models\Personnel;
use Livewire\Attributes\On;
use App\Livewire\BaseCreateLocation;
use Illuminate\Contracts\Validation\Rule;

class PersonnelCreate extends BaseCreateLocation
{
    public $name;
    public $tc_no;
    public $phone;
    public $email;
    public $address;
    public $image;
    public $status;
    public $start_date;
    public $end_date;


    public function rules()
    {
        return array_merge(parent::baseRules(), [
             'code' => ['unique:personnels'],
            'name' => ['required', 'string', 'min:3', 'max:50', 'unique:personnels'],
            'tc_no' => ['nullable', 'string', 'min:11', 'max:11', 'unique:personnels'],
            'phone' => ['nullable', 'string', 'min:15', 'max:15', 'unique:personnels'],
            'email' => ['nullable', 'string', 'min:10', 'max:75', 'unique:personnels'],
            'address' => ['nullable', 'string', 'max:255'],
             'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
             'status' => ['required', 'string', Rule::in(array_keys(PersonnelStatus::options()))],
             'start_date' => ['nullable'],
            'end_date' => ['nullable'],

        ]);
    }

    public function messages()
    {
        return array_merge(parent::baseMessages(), [
            'code.unique' => 'Kod zaten mevcut.',
            'name.required' => 'Ad alanı zorunludur.',
            'name.min' => 'Ad alanı en az 3 karakter olmalıdır.',
            'name.max' => 'Ad alanı en fazla 50 karakter olmalıdır.',
            'name.unique' => 'Ad zaten mevcut.',
            'tc_no.unique' => 'Tc no zaten mevcut.',
            'tc_no.min' => 'Tc no en az 11 karakter olmalıdır.',
            'tc_no.max' => 'Tc no en fazla 11 karakter olmalıdır.',
            'phone.unique' => 'Telefon zaten mevcut.',
            'email.unique' => 'Email zaten mevcut.',
            'address.max' => 'Adres alanı en fazla 255 karakter olmalıdır.',
            'phone.min' => 'Telefon alanı en az 15 karakter olmalıdır.',
            'phone.max' => 'Telefon alanı en fazla 15 karakter olmalıdır.',
            'email.max' => 'Email alanı en fazla 75 karakter olmalıdır.',
            'email.min' => 'Email alanı en az 10 karakter olmalıdır.',
            'status.required' => 'Durum alanı zorunludur.',
            'end_date.date' => 'Bitiş tarihi alanı tarih formatında olmalıdır.',
            'city_id.required' => 'Şehir alanı zorunludur.',
            'district_id.required' => 'İlçe alanı zorunludur.',
            'neighbourhood_id.required' => 'Mahalle alanı zorunludur.',
            'description.max' => 'Açıklama alanı en fazla 255 karakter olmalıdır.',

        ]);
    }

    #[On('openCreateModal')]
    public function openModal()
    {
        $this->open = true;
        $this->resetForm();
        $this->code = Personnel::generateNextCode('PER', 2);
    }

    public function resetForm()
    {
        $this->reset('code', 'name', 'tc_no', 'phone', 'email', 'address', 'image', 'status', 'start_date', 'end_date');
    }

    public function save()
    {
        $this->validate();


        try {
        Personnel::create([
            'code' => $this->code,
            'name' => $this->name,
            'tc_no' => $this->tc_no,
            'phone' => $this->phone,
            'email' => $this->email,
            'city_id' => $this->city_id,
            'district_id' => $this->district_id,
            'neighbourhood_id' => $this->neighbourhood_id,
            'address' => $this->address,
            'image' => $this->image,
            'status' => $this->status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);
        $this->open = false;
        $this->resetForm();
        $this->dispatch('personnel-created');
    } catch (\Exception $e) {
        session()->flash('error', 'Personel kaydedilirken bir hata oluştu.');
    }
    }

    public function render()
    {
        return view('livewire.contact.personnel-create',[
            'statusOptions' => Personnel::statusOptions(),
        ]);
    }
}
