<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function __invoke(Request $request, Product $product)
    {
        $order = Order::create([
            'user_id' => $request->user()->id,
            'product_id' => $product->id,
            'amount' => $product->price,
            'status' => 'pending',
            'transaction_id' => 'TXN-' . Str::random(20),
        ]);

        return redirect()->route('orders.payment', $order);
    }
}
