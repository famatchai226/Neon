<?php

namespace App\Http\Controllers;

use App\Models\DownloadToken;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MyPurchasesController extends Controller
{
    public function __invoke(Request $request)
    {
        $orders = $request->user()->orders()
            ->where('status', 'paid')
            ->with('product')
            ->latest()
            ->get();

        return view('my-purchases', compact('orders'));
    }

    public function download(Request $request, Order $order)
    {
        if ($order->user_id !== $request->user()->id || $order->status !== 'paid') {
            abort(403);
        }

        // Vérifier si un token valide existe déjà
        $token = $order->downloadToken;

        if (!$token || !$token->isValid()) {
            // Supprimer l'ancien token s'il existe
            if ($token) {
                $token->delete();
            }

            // Créer un nouveau token valable 24h
            $token = DownloadToken::create([
                'order_id' => $order->id,
                'token' => Str::random(64),
                'expires_at' => now()->addHours(24),
            ]);
        }

        return redirect()->route('download', $token->token);
    }
}
