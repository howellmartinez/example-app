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
        // todo canfilterby trait
        return view('livewire.sales-order.sales-order-table', [
            'salesOrders' => SalesOrder::when($this->sortField, function ($query) {
                return $query->sortBy($this->sortField, $this->sortDirection);
            })->paginate(20)
        ]);
    }

    // public function render()
    // {
    //     return view('livewire.sales-order.sales-order-table', [
    //         'salesOrders' => SalesOrder::where('date', 'like', "%{$this->search}%")
    //             ->when($this->sortField, function ($query) {
    //                 $query->orderBy($this->sortField, $this->sortAsc ? 'ASC' : 'DESC');
    //             })->paginate(20)
    //     ]);
    // }
}
