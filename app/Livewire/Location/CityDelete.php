<?php

namespace App\Livewire\Location;

use App\Models\City;
use Livewire\Component;
use Livewire\Attributes\On;

class CityDelete extends Component
{
    public $open = false;
    public $cityId;

    #[On('openDeleteModal')]
    public function openModal($id)
    {
        $this->open = true;
        $this->cityId = $id['id'] ?? $id;
    }

    public function delete()
    {
        if ($this->cityId) {
            City::destroy($this->cityId);
            $this->dispatch('city-deleted');
            $this->open = false;
        }
    }

    public function render()
    {
        return view('livewire.location.city-delete');
    }
}
