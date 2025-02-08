<?php

namespace App\Livewire\Contact;

use App\Models\Customer;
use Livewire\Attributes\On;
use App\Livewire\BaseTable;
class CustomerTable extends BaseTable
{


    #[On('customer-created')]
    #[On('customer-updated')]
    #[On('customer-deleted')]
    public function render()
    {
        $data = Customer::search($this->search)->paginate($this->perPage);
        return view('livewire.contact.customer-table',[
            'data' => $data
        ]);
    }

}
