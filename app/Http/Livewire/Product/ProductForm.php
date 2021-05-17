<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product;

class ProductForm extends Component
{
    public Product $product;
    public $isEdit = true;

    protected $rules = [
        'product.name' => 'required|string',
    ];

    public function mount($product = null)
    {
        if ($product === null) {
            $this->isEdit = false;
            $this->product = new Product();
        }
    }

    public function save()
    {
        $this->validate();
        $this->product->save();
        session()->flash('flash.banner', 'Product saved!');
        if (!$this->isEdit) {
            $this->product = new Product();
        }
    }

    public function render()
    {
        return view('livewire.product.product-form', [
            'product' => $this->product
        ]);
    }
}
