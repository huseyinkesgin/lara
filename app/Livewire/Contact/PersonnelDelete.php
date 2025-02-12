<?php

namespace App\Livewire\Contact;

use Livewire\Component;
use App\Models\Personnel;
use Livewire\Attributes\On;

class PersonnelDelete extends Component
{
    public $open = false;
    public $personnelId;

    #[On('openDeleteModal')]
    public function openModal($id)
    {
        $this->open = true;
        $this->personnelId = $id['id'] ?? $id;
    }

    public function delete()
    {
        if ($this->personnelId) {
            Personnel::destroy($this->personnelId);
            $this->dispatch('personnel-deleted');
            $this->open = false;
        }
    }

    public function render()
    {
        return view('livewire.contact.personnel-delete');
    }
}
