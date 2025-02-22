<?php

namespace App\Livewire\Contact;

use App\Models\Beos\Customer;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Beos\City;
use App\Models\Beos\District;
use App\Models\Beos\Neighborhood;
use App\Models\Beos\Company;
class CustomerEdit extends Component
{
    public $code;
    public $name;
    public $tc_no;
    public $customer_type;
    public $company_id;
    public $customer_group;
    public $phone;
    public $email;
    public $customerId;
    public $city_id;
    public $district_id;
    public $neighborhood_id;
    public $address;
    public $description;

    public $cities;
    public $districts;
    public $neighborhoods;

    public $companies;
    public $open = false;

     public function rules()
    {
    return [
        'code' => "required|string|min:4|max:30|unique:customers,code,{$this->customerId}",
        'name' => "required|string|min:3|max:30|unique:customers,name,{$this->customerId}",
        'tc_no' => "nullable|string|min:11|max:11",
        'customer_type' => "nullable|string|min:3|max:60",
        'company_id' => "nullable",
        'phone' => "nullable|string|min:3|max:30|unique:customers,phone,{$this->customerId}",
        'email' => "nullable|string|min:3|max:30|unique:customers,email,{$this->customerId}",
        'customer_group' => "nullable|string|min:3|max:60",
        'city_id' => "nullable",
        'district_id' => "nullable",
        'neighborhood_id' => "nullable",
        'address' => "nullable|string|min:15|max:255",
        'description' => "nullable|string|max:255",
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
            'phone.min' => 'Telefon alanı en az 10 karakter olmalıdır.',
            'phone.max' => 'Telefon alanı en fazla 10 karakter olmalıdır.',
            'phone.unique' => 'Telefon alanı benzersiz olmalıdır.',
            'email.min' => 'Email alanı en az 3 karakter olmalıdır.',
            'email.max' => 'Email alanı en fazla 30 karakter olmalıdır.',
            'email.unique' => 'Email alanı benzersiz olmalıdır.',
            'address.max' => 'Adres alanı en fazla 255 karakter olmalıdır.',
            'description.max' => 'Açıklama alanı en fazla 255 karakter olmalıdır.',
        ];
    }

    public function mount()
    {
        $this->cities = City::active()->get();
        $this->companies = Company::all();
        $this->districts = District::active()->get();
        $this->neighborhoods = Neighborhood::active()->get();
    }

    public function updatedCityId($value)
    {
        $this->city_id = $value;
        $this->districts = District::where('city_id', $value)->get();
        $this->district_id = null;
        $this->neighborhood_id = null;
    }

    public function updatedDistrictId($value)
    {
        $this->district_id = $value;
        $this->neighborhoods = Neighborhood::where('district_id', $value)->get();
        $this->neighborhood_id = null;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->setCustomers($id);
        $this->open = true;
    }

    public function setCustomers($id)
    {
        $customer = Customer::find($id);

        $this->customerId = $customer->id;
        $this->code = $customer->code;
        $this->name = $customer->name;
        $this->tc_no = $customer->tc_no;
        $this->customer_type = $customer->customer_type;
        $this->company_id = $customer->company_id;
        $this->customer_group = $customer->customer_group;
        $this->phone = $customer->phone;
        $this->email = $customer->email;
        $this->city_id = $customer->city_id;
        $this->district_id = $customer->district_id;
        $this->neighborhood_id = $customer->neighborhood_id;
        $this->address = $customer->address;
        $this->description = $customer->description;
    }

    public function resetForm()
{
    $this->reset(['code', 'name', 'tc_no', 'customer_type', 'company_id', 'customer_group', 'phone', 'email', 'city_id', 'district_id', 'neighborhood_id', 'address', 'description']);

}



    public function save()
    {
        $validatedData = $this->validate();
           try {


        $customer = Customer::findOrFail($this->customerId);
        $customer->update($validatedData);

        $this->dispatch('customer-updated');
        $this->open = false;
        $this->resetForm();

            session()->flash('message', 'Müşteri başarıyla güncellendi.');
        } catch (\Exception $e) {
            session()->flash('error', 'Güncelleme sırasında bir hata oluştu: ' . $e->getMessage());
        }
    }


    public function render()
    {

        return view('livewire.contact.customer-edit');
    }
}
