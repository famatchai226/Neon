<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Models\DownloadToken;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function show(Order $order)
    {
        // Vérifier que la commande appartient à l'utilisateur connecté
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('orders.payment', compact('order'));
    }

    public function simulate(Order $order)
    {
        // Vérifier que la commande appartient à l'utilisateur connecté
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->status === 'paid') {
            return redirect()->route('orders.payment', $order)
                ->with('error', 'Cette commande est déjà payée.');
        }

        // Marquer la commande comme payée
        $order->update(['status' => 'paid']);

        // Générer un token de téléchargement valable 24h
        $token = DownloadToken::create([
            'order_id' => $order->id,
            'token' => Str::random(64),
            'expires_at' => now()->addHours(24),
        ]);

        // Envoyer l'email de confirmation
        $downloadUrl = route('download', $token->token);
        Mail::to($order->user->email)->send(new OrderConfirmation($order, $downloadUrl));

        return redirect()->route('orders.payment', $order)
            ->with('success', 'Paiement simulé avec succès ! Votre lien de téléchargement vous a été envoyé par email.');
    }
}
