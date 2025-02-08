<?php

namespace App\Livewire\Contact;

use Livewire\Component;
use Livewire\Attributes\Title;
class CustomerIndex extends Component
{
    #[Title('Müşteriler')]
    public function render()
    {
        return view('livewire.contact.customer-index');
    }
}
