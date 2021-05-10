<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Customer;

class CustomerEditForm extends Component
{
    public Customer $customer;

    protected $rules = [
        'customer.name' => 'required|string',
    ];

    public function save()
    {
        $this->validate();
        $this->customer->save();
        session('flash.banner', 'Customer updated!');
    }

    public function render()
    {
        return view('livewire.customer.customer-form');
    }
}
