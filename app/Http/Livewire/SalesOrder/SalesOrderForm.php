<?php

namespace App\Http\Livewire\SalesOrder;

use Livewire\Component;
use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;
use App\Models\Customer;
use App\Models\Product;

class SalesOrderForm extends Component
{
    public SalesOrder $salesOrder;
    public $salesOrderDetails = [];

    public $isEdit = true;

    public $listeners = [
        'addSalesOrderDetail',
        'editSalesOrderDetail'
    ];

    protected $rules = [
        'salesOrder.customer_id' => 'numeric',
        'salesOrder.date' => 'date',
   ];

    public function mount($salesOrder = null)
    {
        if ($salesOrder === null) {
            $this->isEdit = false;
            $this->salesOrder = new SalesOrder();
        } else {
            // https://github.com/livewire/livewire/issues/2749
            $this->salesOrderDetails = $this->salesOrder->salesOrderDetails->all();
        }
    }

    public function addSalesOrderDetail($data)
    {
        $this->salesOrderDetails[] = SalesOrderDetail::make($data);
    }

    public function editSalesOrderDetail($index, $data)
    {
        $this->salesOrderDetails[$index] = array_merge($this->salesOrderDetails[$index], $data);
    }

    public function save()
    {
        $this->validate([
            'salesOrder.customer_id' => 'required',
            'salesOrder.date' => 'required',
        ]);

        $this->salesOrder->total = collect($this->salesOrderDetails)->sum(fn ($d) => $d['quantity'] * $d['unit_price']);
        $this->salesOrder->save();
        $this->salesOrder->salesOrderDetails()->sync($this->salesOrderDetails);
       
        if (!$this->isEdit) {
            $this->salesOrder = new SalesOrder();
            $this->salesOrderDetails = [];
        }
    }

    public function remove($index)
    {
        array_splice($this->salesOrderDetails, $index, 1);
    }

    public function initModal($index = null)
    {
        if ($index !== null) {
            $this->emit('showModal', $index, $this->salesOrderDetails[$index]);
        } else {
            $this->emit('showModal');
        }
    }

    public function render()
    {
        return view('livewire.sales-order.sales-order-form', [
            'customers' => Customer::select('id', 'name')->get(),
            'productOptions' => Product::select('id', 'name')->pluck('name', 'id'),
        ]);
    }
}
