<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Http\Livewire\WithSorting;

class ProductTable extends Component
{
    use WithPagination;
    use WithSorting;

    public $search;
    public $confirmingDelete = false;
    public $toDelete = null;

    public $queryString = ['search'];

    public function confirmDelete(Product $product)
    {
        $this->confirmingDelete = true;
        $this->toDelete = $product;
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

    public function delete(Product $product)
    {
        $product->delete();
    }

    public function render()
    {
        return view('livewire.product.product-table', [
            'products' => Product::when($this->search, function ($query) {
                return $query->filterBy('search', "%{$this->search}%", 'like');
            })->when($this->sortField, function ($query) {
                return $query->sortBy($this->sortField, $this->sortDirection);
            })->paginate()
        ]);
    }
}
