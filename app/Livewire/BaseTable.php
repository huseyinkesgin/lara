<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class BaseTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $selectedRowId = null;

    public function selectRow($id)
    {
        if ($this->selectedRowId == $id) {
            $this->selectedRowId = null;
        } else {
            $this->selectedRowId = $id;
        }
    }

    public function deleteSelected()
    {
        if ($this->selectedRowId) {
            $this->dispatch('openDeleteModal', $this->selectedRowId);
        }
    }

    public function editSelected()
    {
        if ($this->selectedRowId) {
            $this->dispatch('openEditModal', $this->selectedRowId);
        }
    }

    public function render()
    {
        return view('livewire.base-table');
    }
}
