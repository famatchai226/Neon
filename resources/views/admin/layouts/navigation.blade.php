<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('admin.dashboard') }}" class="font-bold text-lg text-gray-800">
                        {{ config('app.name', 'Neon') }}
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-900">
                        Produits
                    </a>
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">
                        Voir le site
                    </a>
                </div>
            </div>

            <div class="flex items-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-600 hover:text-gray-900">
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
