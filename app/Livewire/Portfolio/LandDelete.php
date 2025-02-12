<?php

namespace App\Livewire\Portfolio;

use App\Models\Land;
use Livewire\Component;
use Livewire\Attributes\On;


class LandDelete extends Component
{

    public $open = false;
    public $landId;

    #[On('openDeleteModal')]
    public function openModal($id)
    {
        $this->open = true;
        $this->landId = $id['id'] ?? $id;
    }

    public function delete()
    {
        if ($this->landId) {
            Land::destroy($this->landId);
            $this->dispatch('land-deleted');
            $this->open = false;
        }
    }

    public function render()
    {
        return view('livewire.portfolio.land-delete');
    }
}
