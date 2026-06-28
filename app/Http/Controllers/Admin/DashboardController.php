<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = \App\Models\Product::count();
        $totalOrders = \App\Models\Order::count();
        $paidOrders = \App\Models\Order::where('status', 'paid')->count();
        $recentOrders = \App\Models\Order::with(['user', 'product'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'paidOrders',
            'recentOrders'
        ));
    }
}
