<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-8">Nos produits</h1>

        @if($products->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Aucun produit disponible pour le moment.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit($product->description ?? 'Aucune description', 120) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-gray-900">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                                <a href="{{ route('products.show', $product) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                    Voir détail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
