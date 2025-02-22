<?php

namespace App\Livewire\Location;

use App\Models\Beos\City;
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
        try {
            if ($this->cityId) {
                City::destroy($this->cityId);
                $this->dispatch('city-deleted');
                $this->open = false;
                
                // Başarı bildirimi
                $this->dispatch('swal', [
                    'toast' => true,
                    'icon' => 'success',
                    'title' => 'Başarılı!',
                    'text' => 'Şehir başarıyla silindi.'
                ]);
            }
        } catch (\Exception $e) {
            // Hata bildirimi
            $this->dispatch('swal', [
                'toast' => true,
                'icon' => 'error',
                'title' => 'Hata!',
                'text' => 'Şehir silinirken bir hata oluştu: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.location.city-delete');
    }
}
