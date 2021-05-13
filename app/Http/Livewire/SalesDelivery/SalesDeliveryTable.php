<?php

namespace App\Http\Livewire\SalesDelivery;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Database\Eloquent\Model;
use App\Models\SalesDelivery;
use App\Http\Livewire\WithSorting;

class SalesDeliveryTable extends Component
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
        session()->flash('message', 'SalesDelivery deleted.');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.sales-delivery.sales-delivery-table', [
            'salesDeliveries' => SalesDelivery::when($this->search, function ($query) {
                // return $query->search("%{$this->search}%", 'like');
                return $query->filterBy('search', "%{$this->search}%", 'like');
            })->when($this->sortField, function ($query) {
                return $query->sortBy($this->sortField, $this->sortDirection);
            })->paginate(20)
        ]);
    }
}
