<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
