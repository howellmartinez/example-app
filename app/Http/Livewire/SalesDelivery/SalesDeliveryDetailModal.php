<?php

namespace App\Http\Livewire\SalesDelivery;

use Livewire\Component;
use App\Models\Product;
use App\Models\WarehouseProduct;

class SalesDeliveryDetailModal extends Component
{
    public $productWarehouseId = null;
    public $quantity = 0;
    public $unitPrice = 0;

    public $listeners = ['showModal'];
    public $show = false;
    public $isEdit = false;
    public $detailIndex = null;
    public $warehouseId = null;

    protected $rules = [
        'productWarehouseId' => 'required|numeric',
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

    public function showModal($warehouseId, $index = null, $salesDeliveryDetail = null)
    {
        if ($salesDeliveryDetail !== null) {
            $this->isEdit = true;
            $this->fill([
                'productWarehouseId' => $salesDeliveryDetail['product_warehouse_id'],
                'quantity' => $salesDeliveryDetail['quantity'],
                'unitPrice' => $salesDeliveryDetail['unit_price'],
            ]);
        } else {
            $this->reset();
        }
        
        $this->warehouseId = $warehouseId;
        $this->detailIndex = $index;
        $this->show = true;
    }

    public function okay()
    {
        $this->validate();
        $payload = [
            'product_warehouse_id' => $this->productWarehouseId,
            'quantity' => $this->quantity,
            'unit_price' => $this->unitPrice,
            'line_total' => $this->lineTotal,
        ];
        if ($this->isEdit) {
            $this->emit('editSalesDeliveryDetail', $this->detailIndex, $payload);
        } else {
            $this->emit('addSalesDeliveryDetail', $payload);
        }
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.sales-delivery.sales-delivery-detail-modal', [
            'warehouseProducts' => WarehouseProduct::with('product')
                ->whereWarehouseId($this->warehouseId)
                ->get()
        ]);
    }
}
