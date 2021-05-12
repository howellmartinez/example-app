<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Customer;

class CustomerForm extends Component
{
    public Customer $customer;
    public $isEdit = true;

    protected $rules = [
        'customer.name' => 'required|string',
    ];

    public function mount($customer = null)
    {
        if ($customer === null) {
            $this->isEdit = false;
            $this->customer = new Customer();
        }
    }

    public function save()
    {
        $this->validate();
        $this->customer->save();
        session()->flash('flash.banner', 'Customer saved!');
        if (!$this->isEdit) {
            $this->customer = new Customer();
        }
    }

    public function render()
    {
        return view('livewire.customer.customer-form', [
            'customer' => $this->customer
        ]);
    }
}
