<?php

namespace App\Livewire\Contact;

use Livewire\Component;
use Livewire\Attributes\Title;
class CompanyIndex extends Component
{
    #[Title('Firma Listesi')]
    public function render()
    {
        return view('livewire.contact.company-index');
    }
}
