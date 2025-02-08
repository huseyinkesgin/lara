<?php

namespace App\Livewire\Contact;

use App\Models\Company;
use App\Livewire\BaseEditLocation;
use Livewire\Attributes\On;

class CompanyEdit extends BaseEditLocation
{

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
    public $companyId;


     public function rules()
    {
    return [
        'code' => "unique:companies,code,{$this->companyId}",
        'name' => "required|string|min:3|max:30|unique:companies,name,{$this->companyId}",
        'tax_name' => "nullable|string|min:3|max:200",
        'tax_office' => "nullable|string|min:3|max:60",
        'tax_number' => "nullable|string|min:3|max:13|unique:companies,tax_number,{$this->companyId}",
        'phone' => "nullable|string|min:3|max:30|unique:companies,phone,{$this->companyId}",
        'email' => "nullable|string|min:3|max:30|unique:companies,email,{$this->companyId}",
        'mersis_number' => "nullable|string|min:16|max:16|unique:companies,mersis_number,{$this->companyId}",
        'kep_address' => "nullable|string|min:3|max:30|unique:companies,kep_address,{$this->companyId}",
        'website' => "nullable|string|min:3|max:30|unique:companies,website,{$this->companyId}",
        'address' => "nullable|string|min:15|max:255",

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
            'tax_name.min' => 'Vergi Adı alanı en az 3 karakter olmalıdır.',
            'tax_name.max' => 'Vergi Adı alanı en fazla 200 karakter olmalıdır.',
            'tax_office.min' => 'Vergi Ofisi alanı en az 3 karakter olmalıdır.',
            'tax_office.max' => 'Vergi Ofisi alanı en fazla 30 karakter olmalıdır.',
            'tax_number.min' => 'Vergi Numarası alanı en az 10 karakter olmalıdır.',
            'tax_number.max' => 'Vergi Numarası alanı en fazla 10 karakter olmalıdır.',
            'tax_number.unique' => 'Vergi Numarası alanı benzersiz olmalıdır.',
            'phone.min' => 'Telefon alanı en az 10 karakter olmalıdır.',
            'phone.max' => 'Telefon alanı en fazla 10 karakter olmalıdır.',
            'phone.unique' => 'Telefon alanı benzersiz olmalıdır.',
            'email.min' => 'Email alanı en az 3 karakter olmalıdır.',
            'email.max' => 'Email alanı en fazla 30 karakter olmalıdır.',
            'email.unique' => 'Email alanı benzersiz olmalıdır.',
            'mersis_number.min' => 'Mersis Numarası alanı en az 16 karakter olmalıdır.',
            'mersis_number.max' => 'Mersis Numarası alanı en fazla 16 karakter olmalıdır.',
            'mersis_number.unique' => 'Mersis Numarası alanı benzersiz olmalıdır.',
            'kep_address.min' => 'Kep Adresi alanı en az 3 karakter olmalıdır.',
            'kep_address.max' => 'Kep Adresi alanı en fazla 30 karakter olmalıdır.',
            'kep_address.unique' => 'Kep Adresi alanı benzersiz olmalıdır.',
            'website.min' => 'Website alanı en az 3 karakter olmalıdır.',
            'website.max' => 'Website alanı en fazla 30 karakter olmalıdır.',
            'website.unique' => 'Website alanı benzersiz olmalıdır.',
            'address.max' => 'Adres alanı en fazla 255 karakter olmalıdır.',
          ];
    }


    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->setCompanies($id);
        $this->open = true;
    }

    public function setCompanies($id)
    {
        $company = Company::find($id);

        $this->companyId = $company->id;
        $this->code = $company->code;
        $this->name = $company->name;
        $this->tax_name = $company->tax_name;
        $this->tax_office = $company->tax_office;
        $this->tax_number = $company->tax_number;
        $this->phone = $company->phone;
        $this->email = $company->email;
        $this->mersis_number = $company->mersis_number;
        $this->kep_address = $company->kep_address;
        $this->website = $company->website;
        $this->city_id = $company->city_id;
        $this->district_id = $company->district_id;
        $this->neighbourhood_id = $company->neighbourhood_id;
        $this->address = $company->address;
        $this->description = $company->description;
    }

    public function resetForm()
{
    $this->reset(['code', 'name', 'tax_name', 'tax_office', 'tax_number', 'phone', 'email', 'mersis_number', 'kep_address', 'website', 'city_id', 'district_id', 'neighbourhood_id', 'address', 'description']);

}


    public function save()
    {
        $validatedData = $this->validate();
           try {


        $company = Company::findOrFail($this->companyId);
        $company->update($validatedData);

        $this->dispatch('company-updated');
        $this->open = false;
        $this->resetForm();

            session()->flash('message', 'Firma başarıyla güncellendi.');
        } catch (\Exception $e) {
            session()->flash('error', 'Güncelleme sırasında bir hata oluştu: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.contact.company-edit');
    }
}

