<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Http\Livewire\WithSorting;

class CustomerTable extends Component
{
    use WithPagination;
    use WithSorting;

    public $search;
    public $confirmingDelete = false;
    public $toDelete = null;

    public $queryString = ['search'];

    public function confirmDelete(Customer $customer)
    {
        $this->confirmingDelete = true;
        $this->toDelete = $customer;
    }

    public function doDelete()
    {
        $this->toDelete->delete();
        $this->toDelete = null;
        $this->confirmingDelete = false;
        session()->flash('banner', 'Sales Order deleted.');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(Customer $customer)
    {
        $customer->delete();
    }

    public function render()
    {
        return view('livewire.customer.customer-table', [
            'customers' => Customer::where('name', 'like', "%{$this->search}%")
                ->when($this->sortField, function ($query) {
                    $query->orderBy($this->sortField, $this->sortAsc ? 'ASC' : 'DESC');
                })->paginate(20)
        ]);
    }
}
