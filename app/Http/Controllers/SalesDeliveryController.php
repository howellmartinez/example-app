<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesDelivery;

class SalesDeliveryController extends Controller
{
    public function index()
    {
        return view('sales-delivery.sales_delivery_index');
    }

    public function create()
    {
        return view('sales-delivery.sales_delivery_create');
    }

    public function show(SalesDelivery $salesDelivery)
    {
        return view('sales_delivery_show', compact('salesDelivery'));
    }

    public function edit(SalesDelivery $salesDelivery)
    {
        return view('sales-delivery.sales_delivery_edit', compact('salesDelivery'));
    }
}
