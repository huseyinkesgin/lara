<?php

namespace App\Livewire\Contact;

use App\Models\Beos\Customer;
use Livewire\Attributes\On;
use App\Models\Beos\Company;
use App\Livewire\BaseCreateLocation;

class CustomerCreate extends BaseCreateLocation
{
    public $name;
    public $tc_no;
    public $customer_type;
    public $company_id;
    public $customer_group;
    public $phone;
    public $email;    public $address;

    public $companies = [];

    public function rules()
    {
        return  [
            'code' => ['unique:customers'],
            'name' => ['required', 'string', 'min:3', 'max:50', 'unique:customers'],
            'tc_no' => ['nullable', 'string', 'min:11', 'max:11', 'unique:customers'],
            'customer_type' => ['required', 'string'],
            'company_id' => ['nullable'],
            'customer_group' => ['required', 'string'],
            'phone' => ['nullable', 'string', 'min:15', 'max:15', 'unique:customers'],
            'email' => ['nullable', 'string', 'min:10', 'max:75', 'unique:customers'],
            'address' => ['nullable', 'string', 'max:255'],
        ];
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
            'customer_type.required' => 'Müşteri tipi zorunludur.',
            'customer_group.required' => 'Müşteri grubu zorunludur.',
            'phone.unique' => 'Telefon zaten mevcut.',
            'email.unique' => 'Email zaten mevcut.',
            'address.max' => 'Adres alanı en fazla 255 karakter olmalıdır.',
            'phone.min' => 'Telefon alanı en az 15 karakter olmalıdır.',
            'phone.max' => 'Telefon alanı en fazla 15 karakter olmalıdır.',
            'email.max' => 'Email alanı en fazla 75 karakter olmalıdır.',
            'email.min' => 'Email alanı en az 10 karakter olmalıdır.',
        ]);
    }

    public function mount()
    {
        parent::mount();
        $this->companies = Company::active()->get();
    }

    #[On('openCreateModal')]
    public function openModal()
    {
        $this->open = true;
        $this->resetForm();
        $this->code = Customer::generateNextCode('MŞTR', 4);
    }

    public function resetForm()
    {
        $this->reset('code', 'name', 'tc_no', 'customer_type', 'company_id', 'customer_group', 'phone', 'email', 'city_id', 'district_id', 'neighborhood_id', 'address', 'description');
    }

    public function save()
    {
       $validatedData = $this->validate();

        try {
        Customer::create($validatedData);
        $this->open = false;
        $this->resetForm();
        $this->dispatch('customer-created');
    } catch (\Exception $e) {
        session()->flash('error', 'Müşteri kaydedilirken bir hata oluştu.');
    }
    }

    public function render()
    {
        return view('livewire.contact.customer-create');
    }
}
