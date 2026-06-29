<x-app-layout>
    <div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-2xl font-bold mb-6">Paiement de la commande</h1>

            <div class="border-b pb-4 mb-4">
                <p class="text-gray-600">Produit : <span class="font-semibold">{{ $order->product->name }}</span></p>
                <p class="text-gray-600">Montant : <span class="font-semibold text-xl">{{ number_format($order->amount, 0, ',', ' ') }} FCFA</span></p>
                <p class="text-gray-600">Statut : 
                    <span class="px-2 py-1 text-sm rounded {{ $order->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $order->status === 'paid' ? 'Payée' : 'En attente de paiement' }}
                    </span>
                </p>
            </div>

            @if($order->status === 'pending')
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
                    <p class="text-yellow-800 mb-4">
                        Le paiement via Mobile Money (Orange Money, MTN) sera intégré prochainement.
                    </p>
                    <p class="text-gray-600 text-sm">
                        Transaction : {{ $order->transaction_id }}
                    </p>
                </div>
            @else
                <div class="bg-green-50 border border-green-200 rounded-lg p-6 text-center">
                    <p class="text-green-800 font-semibold">Paiement confirmé !</p>
                </div>
            @endif

            <div class="mt-6 text-center">
                <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800">
                    Retour au tableau de bord
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
