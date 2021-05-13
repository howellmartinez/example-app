<?php

namespace App\Http\Livewire\SalesDelivery;

use Livewire\Component;
use App\Models\SalesOrderDetail;

class SalesOrderDetailTableModal extends Component
{
    public $salesOrderDetails = [];

    public $listeners = ['showSalesOrderDetailTableModal'];
    public $show = false;

    public $rules = [
        'salesOrderDetails.*.to_deliver' => 'numeric'
    ];

    public function showSalesOrderDetailTableModal($customerId)
    {
        $this->salesOrderDetails = SalesOrderDetail::whereHas('salesOrder', function ($query) use ($customerId) {
            return $query->whereCustomerId($customerId);
        })->pending()->get();
        $this->show = true;
    }

    public function okay()
    {
        // $this->validate();
        $payload = $this->salesOrderDetails->filter(fn ($sod) => !!$sod->to_deliver);
        $this->emit('addFromSalesOrderDetails', $payload);
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.sales-delivery.sales-order-detail-table-modal');
    }
}
