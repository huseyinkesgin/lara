<?php

namespace App\Livewire\Contact;

use App\Models\Beos\Company;
use Livewire\Component;
use Livewire\Attributes\On;

class CompanyDelete extends Component
{
    public $open = false;
    public $companyId;

    #[On('openDeleteModal')]
    public function openModal($id)
    {
        $this->open = true;
        $this->companyId = $id['id'] ?? $id;
    }

    public function delete()
    {
        try {
            if ($this->companyId) {
                Company::destroy($this->companyId);
                $this->dispatch('company-deleted');
                $this->open = false;
                
                // Başarı bildirimi
                $this->dispatch('swal', [
                    'toast' => true,
                    'icon' => 'success',
                    'title' => 'Başarılı!',
                    'text' => 'Şirket başarıyla silindi.'
                ]);
            }
        } catch (\Exception $e) {
            // Hata bildirimi
            $this->dispatch('swal', [
                'toast' => true,
                'icon' => 'error',
                'title' => 'Hata!',
                'text' => 'Şirket silinirken bir hata oluştu: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.contact.company-delete');
    }
}
