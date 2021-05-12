<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesOrder;

class SalesOrderController extends Controller
{
    public function index()
    {
        return view('sales-order.sales_order_index');
    }

    public function create()
    {
        return view('sales-order.sales_order_create');
    }

    public function show(SalesOrder $salesOrder)
    {
        return view('sales_order_show', compact('salesOrder'));
    }

    public function edit(SalesOrder $salesOrder)
    {
        return view('sales-order.sales_order_edit', compact('salesOrder'));
    }
}
