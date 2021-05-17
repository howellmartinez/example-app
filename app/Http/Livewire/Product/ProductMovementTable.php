<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Http\Livewire\WithSorting;
use CometOneSolutions\Inventory\Models\ItemMovement;

class ProductMovementTable extends Component
{
    public Product $product;
    public $itemMovements;

    use WithPagination;
    use WithSorting;

    public $search;
    public $queryString = ['search'];

    public function mount()
    {
       $this->sortAsc = false;
    //    $this->page = ;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.product.product-movement-table', [
            'movements' => ItemMovement::whereInventoryId($this->product->id)
                ->locationTypeIsIn()
                ->when($this->sortField, function ($query) {
                    return $query->orderBy($this->sortField, $this->sortDirection);
                })->paginate()
            // ::when($this->search, function ($query) {
            //     return $query->filterBy('search', "%{$this->search}%", 'like');
        ]);
    }
}
