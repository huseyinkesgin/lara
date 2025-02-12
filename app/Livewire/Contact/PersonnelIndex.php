<?php

namespace App\Livewire\Contact;

use Livewire\Component;
use Livewire\Attributes\Title;
class PersonnelIndex extends Component
{
    #[Title('Personel Listesi')]
    public function render()
    {
        return view('livewire.contact.personnel-index');
    }
}
