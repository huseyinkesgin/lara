<?php

namespace App\Livewire\Contact;

use App\Models\Company;
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
        if ($this->companyId) {
            Company::destroy($this->companyId);
            $this->dispatch('company-deleted');
            $this->open = false;
        }
    }

    public function render()
    {
        return view('livewire.contact.company-delete');
    }
}
