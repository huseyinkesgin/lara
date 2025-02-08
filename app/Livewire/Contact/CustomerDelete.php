<?php

namespace App\Livewire\Contact;

use App\Models\Customer;
use Livewire\Component;
use Livewire\Attributes\On;

class CustomerDelete extends Component
{
    public $open = false;
    public $customerId;

    #[On('openDeleteModal')]
    public function openModal($id)
    {
        $this->open = true;
        $this->customerId = $id['id'] ?? $id;
    }

    public function delete()
    {
        if ($this->customerId) {
            Customer::destroy($this->customerId);
            $this->dispatch('customer-deleted');
            $this->open = false;
        }
    }

    public function render()
    {
        return view('livewire.contact.customer-delete');
    }
}
