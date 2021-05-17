<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.product_index');
    }

    public function create()
    {
        return view('product.product_create');
    }

    public function show(Product $product)
    {
        return view('product.product_show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('product.product_edit', compact('product'));
    }

    public function movements(Product $product)
    {
        return view('product.product_movements', compact('product'));
    }
}
