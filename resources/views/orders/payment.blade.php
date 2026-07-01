<x-app-layout>
    <div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-2xl font-bold mb-6">Paiement de la commande</h1>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

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
                        Le paiement via Mobile Money sera bientôt disponible.
                    </p>
                    <p class="text-gray-600 text-sm mb-4">
                        Transaction : {{ $order->transaction_id }}
                    </p>

                    {{-- Bouton de simulation de paiement (temporaire) --}}
                    <form action="{{ route('orders.payment.simulate', $order) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition font-semibold">
                            Simuler le paiement
                        </button>
                    </form>
                    <p class="text-xs text-gray-400 mt-2">Ce bouton sera remplacé par l'intégration CinetPay</p>
                </div>
            @else
                <div class="bg-green-50 border border-green-200 rounded-lg p-6 text-center">
                    <p class="text-green-800 font-semibold text-lg mb-2">✅ Paiement confirmé !</p>

                    @if($order->downloadToken && $order->downloadToken->isValid())
                        <p class="text-gray-600 mb-4">
                            Votre fichier est prêt à être téléchargé.
                        </p>
                        <a href="{{ route('download', $order->downloadToken->token) }}"
                           class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                            Télécharger mon fichier
                        </a>
                        <p class="text-xs text-gray-400 mt-2">
                            Lien valable jusqu'au {{ $order->downloadToken->expires_at->format('d/m/Y à H:i') }}
                        </p>
                    @else
                        <p class="text-gray-600">
                            Un email de confirmation avec votre lien de téléchargement vous a été envoyé.
                        </p>
                    @endif
                </div>
            @endif

            <div class="mt-6 text-center space-x-4">
                <a href="{{ route('my-purchases') }}" class="text-blue-600 hover:text-blue-800">
                    Mes achats
                </a>
                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-800">
                    Tableau de bord
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
