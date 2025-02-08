<?php

namespace App\Livewire\Location;

use App\Models\City;
use App\Livewire\BaseTable;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CityTable extends BaseTable
{


    #[On('city-created')]
    #[On('city-updated')]
    #[On('city-deleted')]
    public function render()
    {
        $data = City::search($this->search)->paginate($this->perPage);
        return view('livewire.location.city-table',[
            'data' => $data
        ]);
    }


}
