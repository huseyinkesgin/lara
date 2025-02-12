<?php

namespace App\Livewire\Contact;

use Livewire\Component;
use App\Livewire\BaseEditLocation;
use App\Models\Personnel;
use Livewire\Attributes\On;


class PersonnelEdit extends BaseEditLocation
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
    public $personnelId;

     public function rules()
    {
    return [
        'code' => "unique:personnels,code,{$this->personnelId}",
        'name' => "required|string|min:3|max:30|unique:personnels,name,{$this->personnelId}",
        'phone' => "nullable|string|min:3|max:30|unique:personnels,phone,{$this->personnelId}",
        'email' => "nullable|string|min:3|max:30|unique:personnels,email,{$this->personnelId}",
        'tc_no' => "nullable|string|min:11|max:11|unique:personnels,tc_no,{$this->personnelId}",
        'address' => "nullable|string|min:15|max:255",
        'image' => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        'status' => "required|string",
        'start_date' => "required|date",
        'end_date' => "nullable|date",

    ];
    }

    public function messages()
    {
        return [
            'code.unique' => 'Kod alanı benzersiz olmalıdır.',
            'name.required' => 'Ad alanı zorunludur.',
            'name.min' => 'Ad alanı en az 3 karakter olmalıdır.',
            'name.max' => 'Ad alanı en fazla 30 karakter olmalıdır.',
            'name.unique' => 'Ad alanı benzersiz olmalıdır.',
            'phone.min' => 'Telefon alanı en az 10 karakter olmalıdır.',
            'phone.max' => 'Telefon alanı en fazla 10 karakter olmalıdır.',
            'phone.unique' => 'Telefon alanı benzersiz olmalıdır.',
            'email.min' => 'Email alanı en az 3 karakter olmalıdır.',
            'email.max' => 'Email alanı en fazla 30 karakter olmalıdır.',
            'email.unique' => 'Email alanı benzersiz olmalıdır.',
            'address.max' => 'Adres alanı en fazla 255 karakter olmalıdır.',
            'image.image' => 'Resim alanı görsel formatında olmalıdır.',
            'image.mimes' => 'Resim alanı görsel formatında olmalıdır.',
            'image.max' => 'Resim alanı en fazla 2MB olmalıdır.',
            'status.required' => 'Durum alanı zorunludur.',
            'start_date.required' => 'Başlangıç tarihi alanı zorunludur.',
            'end_date.date' => 'Bitiş tarihi alanı tarih formatında olmalıdır.',
          ];
    }


    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->setPersonnel($id);
        $this->open = true;
    }

    public function setPersonnel($id)
    {
        $personnel = Personnel::find($id);

        $this->personnelId = $personnel->id;
        $this->code = $personnel->code;
        $this->name = $personnel->name;
        $this->tc_no = $personnel->tc_no;
        $this->phone = $personnel->phone;
        $this->email = $personnel->email;
        $this->address = $personnel->address;
        $this->image = $personnel->image;
        $this->status = $personnel->status;
        $this->start_date = $personnel->start_date;
        $this->end_date = $personnel->end_date;
        $this->city_id = $personnel->city_id;
        $this->district_id = $personnel->district_id;
        $this->neighbourhood_id = $personnel->neighbourhood_id;
        $this->description = $personnel->description;
    }

    public function resetForm()
{
    $this->reset(['code', 'name', 'tc_no', 'phone', 'email', 'address', 'image', 'status', 'start_date', 'end_date', 'city_id', 'district_id', 'neighbourhood_id', 'description']);

}


    public function save()
    {
         $this->validate();
           try {


        $personnel = Personnel::findOrFail($this->personnelId);
        $personnel->update([
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

        $this->dispatch('personnel-updated');
        $this->open = false;
        $this->resetForm();

            session()->flash('message', 'Personel başarıyla güncellendi.');
        } catch (\Exception $e) {
            session()->flash('error', 'Güncelleme sırasında bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.contact.personnel-edit');
    }
}
