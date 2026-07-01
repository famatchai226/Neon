<?php

namespace App\Http\Controllers;

use App\Models\DownloadToken;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function __invoke(string $token)
    {
        $downloadToken = DownloadToken::where('token', $token)
            ->with('order.product')
            ->first();

        if (!$downloadToken) {
            abort(404, 'Token de téléchargement invalide.');
        }

        if (!$downloadToken->isValid()) {
            abort(419, 'Ce lien de téléchargement a expiré.');
        }

        $product = $downloadToken->order->product;

        if (!$product->file_path || !Storage::disk('private')->exists($product->file_path)) {
            abort(404, 'Fichier introuvable.');
        }

        return Storage::disk('private')->download($product->file_path, $product->name . '.' . pathinfo($product->file_path, PATHINFO_EXTENSION));
    }
}
