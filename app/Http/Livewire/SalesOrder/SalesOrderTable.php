<?php

namespace App\Http\Livewire\SalesOrder;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Database\Eloquent\Model;
use App\Models\SalesOrder;
use App\Http\Livewire\WithSorting;

class SalesOrderTable extends Component
{
    use WithPagination;
    use WithSorting;

    public $search;
    public $confirmingDelete = false;
    public $toDelete = null;

    public $queryString = ['search'];

    public function confirmDelete(Model $model)
    {
        $this->confirmingDelete = true;
        $this->toDelete = $model;
    }

    public function doDelete()
    {
        $this->toDelete->delete();
        $this->toDelete = null;
        $this->confirmingDelete = false;
        session()->flash('message', 'SalesOrder deleted.');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.sales-order.sales-order-table', [
            'salesOrders' => SalesOrder::when($this->search, function ($query) {
                return $query->filterBy('filter', "%{$this->search}%", 'like');
            })->when($this->sortField, function ($query) {
                return $query->sortBy($this->sortField, $this->sortDirection);
            })->paginate(20)
        ]);
    }
}
