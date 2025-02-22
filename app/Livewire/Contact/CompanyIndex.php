<?php

namespace App\Livewire\Contact;

use Livewire\Attributes\Title;
use Livewire\Component;

class CompanyIndex extends Component
{
    #[Title('Firma Listesi')]
    public function render()
    {
        return view('livewire.contact.company-index');
    }
}
