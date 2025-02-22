<?php

namespace App\Livewire\Location;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Beos\Town;

class TownDelete extends Component
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
                Town::destroy($this->cityId);
                $this->dispatch('town-deleted');
                $this->open = false;
                
                // Başarı bildirimi
                $this->dispatch('swal', [
                    'toast' => true,
                    'icon' => 'success',
                    'title' => 'Başarılı!',
                    'text' => 'İlçe başarıyla silindi.'
                ]);
            }
        } catch (\Exception $e) {
            // Hata bildirimi
            $this->dispatch('swal', [
                'toast' => true,
                'icon' => 'error',
                'title' => 'Hata!',
                'text' => 'İlçe silinirken bir hata oluştu: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.location.town-delete');
    }
}
