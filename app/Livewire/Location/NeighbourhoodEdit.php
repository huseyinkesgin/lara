<?php

namespace App\Livewire\Location;

use App\Models\City;
use App\Models\District;
use App\Models\Neighbourhood;
use Livewire\Component;
use Livewire\Attributes\On;

class NeighbourhoodEdit extends Component
{

    public $neighbourhoodId;
    public $city_id;
    public $district_id;
    public $code;
    public $name;
    public $is_active;
    public $description;

    public $cities;
    public $districts;
    public $open = false;

    protected function rules()
    {
        return [
            'district_id' => ['required', 'integer', 'exists:districts,id'],
            'code' => ['required', 'string', 'min:4', 'max:30', 'unique:neighbourhoods,code,' . $this->neighbourhoodId],
            'name' => ['required', 'string', 'min:3', 'max:30', 'unique:neighbourhoods,name,' . $this->neighbourhoodId],
            'is_active' => ['boolean'],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }

    protected function messages()
    {
        return [

            'district_id.required' => 'İlçe alanı zorunludur.',
            'district_id.integer' => 'İlçe alanı sayısal bir değer olmalıdır.',
            'district_id.exists' => 'İlçe alanı geçersiz bir değerdir.',
            'code.required' => 'Kod alanı zorunludur.',
            'code.min' => 'Kod alanı en az 4 karakter olmalıdır.',
            'code.max' => 'Kod alanı en fazla 30 karakter olmalıdır.',
            'code.unique' => 'Kod alanı benzersiz olmalıdır.',
            'name.required' => 'Ad alanı zorunludur.',
            'name.min' => 'Ad alanı en az 3 karakter olmalıdır.',
            'name.max' => 'Ad alanı en fazla 30 karakter olmalıdır.',
            'name.unique' => 'Ad alanı benzersiz olmalıdır.',
            'is_active.boolean' => 'Aktif alanı doğru formatta değil.',
            'description.max' => 'Açıklama alanı en fazla 255 karakter olmalıdır.',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->cities = City::active()->get();
        $this->districts = District::active()->get();
    }

    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->setNeighbourhood($id);
        $this->open = true;
    }


    public function setNeighbourhood($id)
    {
        $neighbourhood = Neighbourhood::find($id);

        $this->neighbourhoodId = $neighbourhood->id;
        $this->city_id = $neighbourhood->district->city_id;
        $this->district_id = $neighbourhood->district_id;
        $this->code = $neighbourhood->code;
        $this->name = $neighbourhood->name;
        $this->is_active = $neighbourhood->is_active;
        $this->description = $neighbourhood->description;
    }

    public function resetForm()
    {
        $this->reset(['neighbourhoodId', 'district_id', 'code', 'name', 'description']);
    }

    public function updatedCityId($value)
    {
        $this->city_id = $value;
        $this->districts = District::where('city_id', $value)->get();
        $this->district_id = null;
    }

    public function save()
    {
        $validatedData = $this->validate();

        try {
            $neighbourhood = Neighbourhood::findOrFail($this->neighbourhoodId);
            $neighbourhood->update($validatedData);

            $this->dispatch('neighbourhood-updated');
            $this->open = false;
        } catch (\Exception $e) {
            session()->flash('error', 'Mahalle güncellenirken bir hata oluştu.');
        }
    }

    public function render()
    {
        return view('livewire.location.neighbourhood-edit');
    }
}
