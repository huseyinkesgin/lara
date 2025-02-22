<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;
use App\Models\Land;
use Livewire\Attributes\On;
use App\Livewire\BaseCreateLocation;
use App\Models\Personnel;
use App\Models\Customer;

class LandCreate extends BaseCreateLocation
{

  
    public $enter_date;
    public $customer_id;
    public $area;
    public $land;
    public $parcel;
    public $zooning_status;
    public $similar;
    public $size;
    public $personnel_id;
    public $personnels = [];
    public $customers = [];

     public function rules()
    {
     return array_merge(parent::baseRules(), [
        'enter_date' => ["nullable","string"],
        'customer_id' => ['required', 'integer'],
        'area' => ['required' ],
        'land' => ['required'],
        'parcel' => ['required'],
        'zooning_status' => ['required', 'string', 'max:255'],
        'similar' => ['nullable', 'string', 'max:255'],
        'size' => ['nullable'],
        'personnel_id' => ['required', 'integer'],
        'description' => ['nullable', 'string', 'max:255'],
        

    ]);
    }

    public function messages()
    {
         return array_merge(parent::baseMessages(), [
            'enter_date.required' => 'Tarih alanı zorunludur.',
            'customer_id.required' => 'Müşteri alanı zorunludur.',
            'area.required' => 'Alan alanı zorunludur.',
            'area.numeric' => 'Alan alanı sayısal olmalıdır.',
            'land.required' => 'Ada alanı zorunludur.',
            'land.numeric' => 'Ada alanı sayısal olmalıdır.',
            'parcel.required' => 'Parsel alanı zorunludur.',
            'parcel.numeric' => 'Parsel alanı sayısal olmalıdır.',
            'zooning_status.required' => 'İmar durumu alanı zorunludur.',
            'zooning_status.max' => 'İmar durumu alanı en fazla 255 karakter olmalıdır.',
            'description.max' => 'Açıklama alanı en fazla 255 karakter olmalıdır.',
            'personnel_id.required' => 'Danışman alanı zorunludur.',
        ]);
    }

     public function mount()
    {
        parent::mount();
        $this->personnels = Personnel::all();
        $this->customers = Customer::all();
    }

     #[On('openCreateModal')]
    public function openModal()
    {
        $this->open = true;
        $this->resetForm();
        $this->code = Land::generateNextCode('ARSA', 4);
    }

    public function resetForm()
    {

        $this->reset('code', 'customer_id','area' ,'city_id','district_id','neighborhood_id','land','parcel','zooning_status','similar','size','personnel_id','description');
    }

    public function save()
    {
        $data =$this->validate();

        try {
       Land::create([
            'code' => $this->code,
            'enter_date' => $this->enter_date,
            'customer_id' => $this->customer_id,
            'city_id' => $this->city_id,
            'district_id' => $this->district_id,
            'neighborhood_id' => $this->neighborhood_id,
            'area' => $this->area,
            'land' => $this->land,
            'parcel' => $this->parcel,
            'zooning_status' => $this->zooning_status,
            'similar' => $this->similar,
            'size' => $this->size,
            'personnel_id' => $this->personnel_id,
            'description' => $this->description,
        ]);
        $this->open = false;
        $this->resetForm();
        $this->dispatch('land-created');
    } catch (\Exception $e) {
        session()->flash('error', 'Arsa kaydedilirken bir hata oluştu.');
    }
    }



    public function render()
    {
        return view('livewire.portfolio.land-create');
    }
}
