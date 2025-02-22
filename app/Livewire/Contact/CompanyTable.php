<?php

namespace App\Livewire\Contact;

use App\Models\Beos\Company;
use Livewire\Attributes\On;
use App\Livewire\BaseTable;

class CompanyTable extends BaseTable
{

    #[On('company-created')]
    #[On('company-updated')]
    #[On('company-deleted')]
    public function render()
    {
        $data = Company::search($this->search)->paginate($this->perPage);
        return view('livewire.contact.company-table',[
            'data' => $data
        ]);
    }
}
