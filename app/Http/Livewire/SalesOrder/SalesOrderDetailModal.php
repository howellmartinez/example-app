<?php

namespace App\Http\Livewire\SalesOrder;

use Livewire\Component;
use App\Models\Product;

class SalesOrderDetailModal extends Component
{
    public $productId = null;
    public $quantity = 0;
    public $unitPrice = 0;

    public $listeners = ['showModal'];
    public $show = false;
    public $isEdit = false;
    public $detailIndex = null;

    protected $rules = [
        'productId' => 'required|numeric',
        'quantity' => 'required|numeric',
        'unitPrice' => 'required|numeric',
    ];

    public function getLineTotalProperty()
    {
        return $this->quantity * $this->unitPrice;
    }

    public function updatedProductId($val)
    {
        $this->unitPrice = Product::find($val)->unit_price;
    }

    public function showModal($index = null, $salesOrderDetail = null)
    {
        if ($salesOrderDetail !== null) {
            $this->isEdit = true;
            $this->fill([
                'productId' => $salesOrderDetail['product_id'],
                'quantity' => $salesOrderDetail['quantity'],
                'unitPrice' => $salesOrderDetail['unit_price'],
            ]);
        } else {
            $this->reset();
        }
        
        $this->detailIndex = $index;
        $this->show = true;
    }

    public function okay()
    {
        $this->validate();
        $payload = [
            'product_id' => $this->productId,
            'quantity' => $this->quantity,
            'unit_price' => $this->unitPrice,
        ];
        if ($this->isEdit) {
            $this->emit('editSalesOrderDetail', $this->detailIndex, $payload);
        } else {
            $this->emit('addSalesOrderDetail', $payload);
        }
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.sales-order.sales-order-detail-modal', [
            'products' => Product::select('id', 'name', 'unit_price')->get(),
        ]);
    }
}
