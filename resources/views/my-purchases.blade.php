<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-8">Mes achats</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($orders->isEmpty())
            <div class="text-center py-12 bg-white rounded-lg shadow">
                <p class="text-gray-500 text-lg mb-4">Vous n'avez pas encore effectué d'achat.</p>
                <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Découvrir nos produits
                </a>
            </div>
        @else
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produit</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Montant</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Téléchargement</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($orders as $order)
                            <tr>
                                <td class="px-6 py-4">
                                    <span class="font-semibold">{{ $order->product->name }}</span>
                                </td>
                                <td class="px-6 py-4">{{ number_format($order->amount, 0, ',', ' ') }} FCFA</td>
                                <td class="px-6 py-4">{{ $order->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('my-purchases.download', $order) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition text-sm">
                                            Télécharger
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
