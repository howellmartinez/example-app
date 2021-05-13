<?php

namespace App\Http\Livewire\SalesDelivery;

use Livewire\Component;
use App\Models\SalesDelivery;
use App\Models\SalesDeliveryDetail;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\WarehouseProduct;
use App\Models\SalesOrderDetail;

class SalesDeliveryForm extends Component
{
    public SalesDelivery $salesDelivery;
    public $salesDeliveryDetails = [];

    public $isEdit = true;

    public $listeners = [
        'addSalesDeliveryDetail',
        'editSalesDeliveryDetail',
        'addFromSalesOrderDetails'
    ];

    protected $rules = [
        'salesDelivery.customer_id' => 'required|numeric',
        'salesDelivery.warehouse_id' => 'required|numeric',
        'salesDelivery.date' => 'required|date',
   ];

    public function mount($salesDelivery = null)
    {
        if ($salesDelivery === null) {
            $this->isEdit = false;
            $this->salesDelivery = new SalesDelivery(['date' => today()->toDateString()]);
        } else {
            // https://github.com/livewire/livewire/issues/2749
            $this->salesDeliveryDetails = $this->salesDelivery->salesDeliveryDetails->all();
        }
    }

    public function toProductWarehouseId($productId)
    {
        if ($this->salesDelivery->warehouse_id == null || $productId == null) {
            return null;
        }

        return WarehouseProduct::whereProductId($productId)->whereWarehouseId($this->salesDelivery->warehouse_id)->first()->id;
    }

    public function addSalesDeliveryDetail($data)
    {
        $this->salesDeliveryDetails[] = SalesDeliveryDetail::make($data);
    }

    public function editSalesDeliveryDetail($index, $data)
    {
        $this->salesDeliveryDetails[$index] = array_merge($this->salesDeliveryDetails[$index], $data);
    }

    public function addFromSalesOrderDetails($salesOrderDetails)
    {
        // Note: Tried mapInto(SalesOrderDetail::class) but the to_deliver attribute is lost
        foreach ($salesOrderDetails as $salesOrderDetail) {
            $this->salesDeliveryDetails[] = SalesDeliveryDetail::make([
                'sales_order_detail_id' => $salesOrderDetail['id'],
                'quantity' => $salesOrderDetail['to_deliver'],
                'product_warehouse_id' => $this->toProductWarehouseId($salesOrderDetail['product_id']),
                'unit_price' =>$salesOrderDetail['unit_price'],
                'line_total' => $salesOrderDetail['unit_price'] * $salesOrderDetail['to_deliver'],
            ]);
        }
    }

    public function save()
    {
        $this->validate();

        $this->salesDelivery->total = collect($this->salesDeliveryDetails)->sum(fn ($sdd) => $sdd['quantity'] * $sdd['unit_price']);
        $this->salesDelivery->save();

        $results = $this->salesDelivery->salesDeliveryDetails()->sync($this->salesDeliveryDetails);

        SalesOrderDetail::whereHas('salesDeliveryDetails', fn ($sdd) => $sdd->whereIn('id', \Arr::flatten($results)))
            ->cursor()->each->updateDelivered();

        if (!$this->isEdit) {
            $this->salesDelivery = new SalesDelivery(['date' => today()->toDateString()]);
            $this->salesDeliveryDetails = [];
        }
    }

    public function remove($index)
    {
        array_splice($this->salesDeliveryDetails, $index, 1);
    }

    public function initModal($index = null)
    {
        // todo validation, choose warehouse first
        if ($index !== null) {
            $this->emit('showModal', $this->salesDelivery->warehouse_id, $index, $this->salesDeliveryDetails[$index]);
        } else {
            $this->emit('showModal', $this->salesDelivery->warehouse_id);
        }
    }

    public function initSalesOrderDetailTableModal()
    {
        // Todo validation, choose customer first
        $this->emit('showSalesOrderDetailTableModal', $this->salesDelivery->customer_id);
    }

    public function render()
    {
        return view('livewire.sales-delivery.sales-delivery-form', [
            'customers' => Customer::select('id', 'name')->pluck('name', 'id'),
            'warehouses' => Warehouse::select('id', 'name')->pluck('name', 'id'),
        ]);
    }
}
