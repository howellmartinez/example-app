<?php

namespace App\Http\Livewire\SalesDelivery;

use Livewire\Component;
use App\Models\Product;
use App\Models\WarehouseProduct;

class SalesDeliveryDetailModal extends Component
{
    public $warehouseProductId = null;
    public $quantity = 0;
    public $unitPrice = 0;
    public $unitCost = 0;

    public $listeners = ['showModal'];
    public $show = false;
    public $isEdit = false;
    public $detailIndex = null;
    public $warehouseId = null;

    protected $rules = [
        'warehouseProductId' => 'required|numeric',
        'quantity' => 'required|numeric',
        'unitPrice' => 'required|numeric',
    ];

    public function getLineTotalProperty()
    {
        return $this->quantity * $this->unitPrice;
    }

    // public function updatedProductId($val)
    // {
    //     $this->unitPrice = Product::find($val)->unit_price;
    // }

    public function updatedWarehouseProductId($val)
    {
        $product = WarehouseProduct::with('product')->find($val)->product;
        $this->unitPrice = $product->unit_price;
        $this->unitCost = $product->unit_cost;
    }

    public function showModal($warehouseId, $index = null, $salesDeliveryDetail = null)
    {
        if ($salesDeliveryDetail !== null) {
            $this->isEdit = true;
            $this->fill([
                'warehouseProductId' => $salesDeliveryDetail['warehouse_product_id'],
                'quantity' => $salesDeliveryDetail['quantity'],
                'unitPrice' => $salesDeliveryDetail['unit_price'],
                'unitCost' => $salesDeliveryDetail['unit_cost'],
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
            'warehouse_product_id' => $this->warehouseProductId,
            'quantity' => $this->quantity,
            'unit_price' => $this->unitPrice,
            'line_total' => $this->lineTotal,
            'unit_cost' => $this->unitCost,
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
