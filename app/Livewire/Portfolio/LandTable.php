<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\BaseTable;
use App\Models\Land;


class LandTable extends BaseTable
{
    #[On('land-created')]
    #[On('land-updated')]
    #[On('land-deleted')]
    public function render()
    {
        $data = Land::search($this->search)->paginate($this->perPage);
        return view('livewire.portfolio.land-table',[
            'data' => $data
        ]);
    }
}
