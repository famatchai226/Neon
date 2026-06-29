<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 mb-6 inline-block">&larr; Retour aux produits</a>

        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>

            <div class="text-4xl font-bold text-gray-900 mb-6">
                {{ number_format($product->price, 0, ',', ' ') }} FCFA
            </div>

            @if($product->description)
                <div class="prose max-w-none mb-8">
                    <p class="text-gray-700 whitespace-pre-line">{{ $product->description }}</p>
                </div>
            @endif

            <div class="border-t pt-6">
                @auth
                    <form action="{{ route('orders.store', $product) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-green-600 text-white text-lg font-semibold py-3 px-6 rounded-lg hover:bg-green-700 transition">
                            Acheter maintenant
                        </button>
                    </form>
                @else
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-gray-600 mb-4">Connectez-vous pour acheter ce produit</p>
                        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                            Se connecter
                        </a>
                        <a href="{{ route('register') }}" class="ml-4 text-blue-600 hover:text-blue-800">
                            S'inscrire
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>
