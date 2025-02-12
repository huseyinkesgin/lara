<?php

namespace App\Livewire\Contact;

use App\Models\Personnel;
use Livewire\Attributes\On;
use App\Livewire\BaseTable;

class PersonnelTable extends BaseTable
{


    #[On('personnel-created')]
    #[On('personnel-updated')]
    #[On('personnel-deleted')]
    public function render()
    {
        $data = Personnel::search($this->search)->paginate($this->perPage);
        return view('livewire.contact.personnel-table',[
            'data' => $data
        ]);
    }

}
