<?php

namespace App\Livewire\Location;

use Livewire\Component;
use App\Models\District;
use Livewire\Attributes\On;
use App\Livewire\BaseTable;

class DistrictTable extends BaseTable
{

    #[On('district-created')]
    #[On('district-updated')]
    #[On('district-deleted')]
    public function render()
    {
        $data = District::search($this->search)->paginate($this->perPage);
        return view('livewire.location.district-table',[
            'data' => $data
        ]);
    }

}
