<?php

namespace App\Livewire\Portfolio;

use App\Models\Land;
use App\Models\Customer;
use App\Models\Personnel;
use Livewire\Attributes\On;
use App\Livewire\BaseEditLocation;


class LandEdit extends BaseEditLocation
{
    public $code;
    public $customer_id;
    public $area;
    public $land;
    public $parcel;
    public $zooning_status;
    public $similar;
    public $size;
    public $personnel_id;
    public $landId;
    public $personnels = [];
    public $customers = [];

     public function rules()
    {
   return array_merge(parent::baseRules(), [
        'code' => "unique:personnels,code,{$this->landId}",
        'enter_date' => ["required","string"],
        'customer_id' => ['required', 'integer'],
        'area' => ['required', 'numeric'],
        'land' => ['required', 'numeric'],
        'parcel' => ['required', 'numeric'],
        'zooning_status' => ['required', 'string', 'max:255'],
        'similar' => ['nullable', 'string', 'max:255'],
        'size' => ['nullable', 'numeric'],
        'personnel_id' => ['required', 'integer'],

    ]);
    }

    public function messages()
    {
        return array_merge(parent::baseMessages(), [
            'code.required' => 'Kod alanı zorunludur.',
            'enter_date.required' => 'Tarih alanı zorunludur.',
            'date.date' => 'Tarih alanı tarih formatında olmalıdır.',
            'customer_id.required' => 'Müşteri alanı zorunludur.',
            'area.required' => 'Alan alanı zorunludur.',
            'area.numeric' => 'Alan alanı sayısal olmalıdır.',
            'land.required' => 'Arsa alanı zorunludur.',
            'land.numeric' => 'Arsa alanı sayısal olmalıdır.',
            'parcel.required' => 'Parsel alanı zorunludur.',
            'parcel.numeric' => 'Parsel alanı sayısal olmalıdır.',
            'zooning_status.required' => 'İmar durumu alanı zorunludur.',
            'zooning_status.max' => 'İmar durumu alanı en fazla 255 karakter olmalıdır.',
            'similar.max' => 'Benzeri alanı en fazla 255 karakter olmalıdır.',
            'size.numeric' => 'Büyüklük alanı sayısal olmalıdır.',
            'personnel_id.required' => 'Danışman alanı zorunludur.',
            'description.max' => 'Açıklama alanı en fazla 255 karakter olmalıdır.',
        ]);
    }

    public function mount()
    {
        parent::mount();
        $this->personnels = Personnel::all();
        $this->customers = Customer::all();

    }


     #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->setLand($id);
        $this->open = true;
    }

    public function setLand()
    {
        $land = Land::find($id);

        $this->code = $land->code;
        $this->customer_id = $land->customer_id;
        $this->date = $land->date;
        $this->city_id = $land->city_id;
        $this->district_id = $land->district_id;
        $this->neighborhood_id = $land->neighborhood_id;
        $this->area = $land->area;
        $this->land = $land->land;
        $this->parcel = $land->parcel;
        $this->zooning_status = $land->zooning_status;
        $this->similar = $land->similar;
        $this->size = $land->size;
        $this->personnel_id = $land->personnel_id;
        $this->landId = $land->id;
    }

     public function resetForm()
    {

        $this->reset('code', 'customer_id','area' ,'city_id','district_id','neighborhood_id','land','parcel','zooning_status','similar','size','personel_id','description');
    }

    public function save()
    {
         $this->validate();
           try {
            $land = Land::findOrFail($this->landId);
            $land->update([
                'code' => $this->code,
                'customer_id' => $this->customer_id,
                'date' => $this->date,
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
            $this->dispatch('land-updated');
            $this->open = false;
            $this->resetForm();

            session()->flash('message', 'Arsa başarıyla güncellendi.');
        } catch (\Exception $e) {
            session()->flash('error', 'Arsa güncellenirken bir hata oluştu.');
        }
    }

    public function render()
    {
        return view('livewire.portfolio.land-edit');
    }
}
