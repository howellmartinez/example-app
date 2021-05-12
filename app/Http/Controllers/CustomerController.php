<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.customer_index');
    }

    public function create()
    {
        return view('customer.customer_create');
    }

    public function show(Customer $customer)
    {
        return view('customer.customer_show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customer.customer_edit', compact('customer'));
    }
}
