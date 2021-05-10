<?php

namespace App\Http\Livewire\SalesOrder;

use Livewire\Component;
use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;
use App\Models\Customer;

class SalesOrderCreateForm extends Component
{
    public SalesOrder $salesOrder;
    public $salesOrderDetails;

    protected $rules = [
        'salesOrder.customer_id' => 'required',
        'salesOrder.date' => 'required',
        // 'salesOrder.*.salesOrderDetails' => 'required',
    ];

    public function mount()
    {
        $this->salesOrder = new SalesOrder();
        $this->salesOrderDetails = collect([]);
    }

    public function save()
    {
        $this->validate();
        $this->salesOrder->save();
        $this->salesOrder->salesOrderDetails()->saveMany($this->salesOrderDetails);
        $this->salesOrder = new SalesOrder();
        $this->salesOrderDetails = collect([]);
    }

    public function add(SalesOrderDetail $salesOrderDetail)
    {
        $this->salesOrderDetails->push($salesOrderDetail);
    }

    public function render()
    {
        return view('livewire.sales-order.sales-order-form', [
            'customers' => Customer::all(),
        ]);
    }
}
