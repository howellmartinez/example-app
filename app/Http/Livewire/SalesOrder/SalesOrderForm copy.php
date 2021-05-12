<?php

namespace App\Http\Livewire\SalesOrder;

use Livewire\Component;
use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;
use App\Models\Customer;
use App\Models\Product;

class SalesOrderFormCopy extends Component
{
    public SalesOrder $salesOrder;
    public $salesOrderDetails = [];

    public $modalSalesOrderDetail = null;
    public $currentIndexEdit = null;
    public $showModal = false;
    public $isEdit = true;

    public function getModalSalesOrderDetailProperty()
    {
        $temp = $this->modalSalesOrderDetail;
        $this->modalSalesOrderDetail->line_total = 300;
        return $temp;
    }

    protected $rules = [
        'salesOrder.customer_id' => 'numeric',
        'salesOrder.date' => 'date',
        'modalSalesOrderDetail.product_id' => 'numeric',
        'modalSalesOrderDetail.quantity' => 'numeric',
        'modalSalesOrderDetail.unit_price' => 'numeric',
        'modalSalesOrderDetail.line_total' => 'numeric',
    ];

    public function mount($salesOrder = null)
    {
        if ($salesOrder === null) {
            $this->isEdit = false;
            $this->salesOrder = new SalesOrder();
        } else {
            $this->salesOrderDetails = $this->salesOrder->salesOrderDetails->all();
        }
    }

    public function save()
    {
        $this->validate([
            'salesOrder.customer_id' => 'required',
            'salesOrder.date' => 'required',
            // 'salesOrder.*.salesOrderDetails' => 'required',
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

    public function saveModal()
    {
        $this->validate([
            'modalSalesOrderDetail.product_id' => 'required|numeric',
            'modalSalesOrderDetail.quantity' => 'required|numeric',
        ]);

        if ($this->currentIndexEdit !== null) {
            $this->salesOrderDetails[$this->currentIndexEdit] = $this->modalSalesOrderDetail;
        } else {
            $this->salesOrderDetails[] = $this->modalSalesOrderDetail;
        }

        $this->currentIndexEdit = null;
        $this->modalSalesOrderDetail = null;
        $this->showModal = false;
    }

    public function initModal($index = null)
    {
        $this->currentIndexEdit = $index;
        $this->showModal = true;
        if ($index !== null) {
            // Note when it comes back from the wire, it becomes an array
            $this->modalSalesOrderDetail = $this->salesOrderDetails[$index];
        } else {
            $this->modalSalesOrderDetail = SalesOrderDetail::make();
        }
    }

    public function render()
    {
        return view('livewire.sales-order.sales-order-form', [
            'customers' => Customer::select('id', 'name')->get(),
            'products' => Product::select('id', 'name')->get(),
        ]);
    }
}
