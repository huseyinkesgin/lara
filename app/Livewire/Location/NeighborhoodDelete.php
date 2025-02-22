<?php

namespace App\Livewire\Location;

use Livewire\Component;
use App\Models\Beos\Neighborhood;
use Livewire\Attributes\On;

class NeighborhoodDelete extends Component
{
    public $neighborhoodId;
    public $open = false;

    #[On('openDeleteModal')]
    public function openDeleteModal($id)
    {
        $this->neighborhoodId = $id;
        $this->open = true;
    }

    public function delete()
    {
        try {
            Neighborhood::destroy($this->neighborhoodId);
            $this->dispatch('neighborhood-deleted');
            $this->open = false;

            $this->dispatch('swal', [
                'toast' => true,
                'icon' => 'success',
                'title' => 'Başarılı!',
                'text' => 'Mahalle başarıyla silindi.'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('swal', [
                'toast' => true,
                'icon' => 'error',
                'title' => 'Hata!',
                'text' => 'Mahalle silinirken bir hata oluştu: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.location.neighborhood-delete');
    }
}
