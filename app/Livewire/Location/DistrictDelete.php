<?php

namespace App\Livewire\Location;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\District;

class DistrictDelete extends Component
{
    public $open = false;
    public $districtId;

    #[On('openDeleteModal')]
    public function openModal($id)
    {
        $this->open = true;
        $this->districtId = $id['id'] ?? $id;
    }

    public function delete()
    {
        if ($this->districtId) {
            District::destroy($this->districtId);
            $this->dispatch('district-deleted');
            $this->open = false;
        }
    }


    public function render()
    {
        return view('livewire.location.district-delete');
    }
}
