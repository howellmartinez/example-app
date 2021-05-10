<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Customer;

class CustomerCreateForm extends Component
{
    public Customer $customer;

    protected $rules = [
        'customer.name' => 'required|string',
    ];

    public function mount()
    {
        $this->customer = new Customer();
    }

    public function save()
    {
        $this->validate();
        $this->customer->save();
        $this->customer = new Customer();
    }

    public function render()
    {
        return view('livewire.customer.customer-form');
    }
}
