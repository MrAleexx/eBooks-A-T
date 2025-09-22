@php
    $links = [
        [
            'nombre' => 'Inicio',
            'ruta' => route('bookmart'),
            'activo' => request()->routeIs('bookmart'),
        ],
        [
            'nombre' => 'Nuestros Libros',
            'ruta' => route('homebook'),
            'activo' => request()->routeIs('homebook'),
        ],
        [
            'nombre' => 'Sobre Nosotros',
            'ruta' => route('homeabout'),
            'activo' => request()->routeIs('homeabout'),
        ],
        [
            'nombre' => 'Contáctanos',
            'ruta' => route('homecontact'),
            'activo' => request()->routeIs('homecontact'),
        ],
    ];

    $cartCount = count(Session::get('cart', []));
@endphp

<div class="container mx-auto mt-4 flex justify-between items-center mb-4 px-4">
    <a href="{{ route('bookmart') }}" class="font-extrabold text-3xl">
        <img src="{{ asset('img/logoAYT.png') }}" class="w-50" alt="">
    </a>

    <nav class="hidden md:flex gap-6 font-medium text-gray-700">
        @foreach ($links as $link)
            <a href="{{ $link['ruta'] }}"
                class="hover:text-orange-500 transition-colors duration-300 {{ $link['activo'] ? 'text-orange-500 font-semibold' : '' }}">{{ $link['nombre'] }}</a>
        @endforeach

        {{-- ENLACE AL PANEL ADMIN - SOLO PARA USUARIOS ADMIN --}}
        @auth
            @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}"
                    class="hover:text-blue-600 transition-colors duration-300 font-semibold text-blue-500">
                    🛠️ Panel Admin
                </a>
            @endif
        @endauth
    </nav>

    <div class="flex items-center gap-2">
        @auth
            <a href="{{ route('cart.index') }}"
                class="bg-orange-400 hover:bg-orange-500 py-2 px-3 rounded cursor-pointer transition-colors duration-300 shadow relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                    stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 17h-11v-14h-2" />
                    <path d="M6 5l14 1l-1 7h-13" />
                </svg>
                @if ($cartCount > 0)
                    <span
                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>
        @else
            <button
                class="bg-orange-400 py-2 px-3 rounded cursor-not-allowed transition-colors duration-300 shadow relative"
                title="Inicia sesión para acceder al carrito">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                    stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 17h-11v-14h-2" />
                    <path d="M6 5l14 1l-1 7h-13" />
                </svg>
            </button>
        @endauth
        {{-- ENLACE A MIS PEDIDOS --}}
        @auth
            <a href="{{ route('orders.index') }}"
                class="bg-white border border-orange-400 text-orange-500 hover:bg-orange-50 py-2 px-4 rounded-lg transition-all duration-300 font-medium flex items-center shadow-sm hover:shadow-md ml-2 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:scale-110 transition-transform"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Mis Pedidos
            </a>
        @endauth


        <button id="menu-btn"
            class="md:hidden py-2 px-3 text-gray-700 cursor-pointer bg-gray-100 rounded hover:bg-gray-200 transition-colors duration-300 shadow">
            <svg id="icon-open" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-menu-2">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M4 6l16 0" />
                <path d="M4 12l16 0" />
                <path d="M4 18l16 0" />
            </svg>

            <svg id="icon-close" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-x hidden">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M18 6l-12 12" />
                <path d="M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

<div id="mobile-menu" class="hidden md:hidden mb-3">
    <nav class="flex flex-col gap-3 bg-gray-50 p-4 mt-2 shadow">
        @foreach ($links as $link)
            <a href="{{ $link['ruta'] }}"
                class="hover:text-orange-500 transition-colors duration-300 {{ $link['activo'] ? 'text-orange-500 font-semibold' : '' }}">{{ $link['nombre'] }}</a>
        @endforeach

        {{-- ENLACE AL PANEL ADMIN EN MÓVIL - SOLO PARA USUARIOS ADMIN --}}
        @auth
            @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}"
                    class="hover:text-blue-600 transition-colors duration-300 font-semibold text-blue-500">
                    🛠️ Panel Admin
                </a>
            @endif
        @endauth

        @auth
            <a href="{{ route('cart.index') }}"
                class="hover:text-orange-500 transition-colors duration-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 17h-11v-14h-2" />
                    <path d="M6 5l14 1l-1 7h-13" />
                </svg>
                Carrito
                @if ($cartCount > 0)
                    <span class="ml-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>
        @else
            <span class="text-gray-400 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="mr-2">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 17h-11v-14h-2" />
                    <path d="M6 5l14 1l-1 7h-13" />
                </svg>
                Carrito (Inicia sesión)
            </span>
        @endauth

        @auth
            <a href="{{ route('orders.index') }}"
                class="hover:text-orange-500 transition-colors duration-300 flex items-center py-2 px-3 rounded-md hover:bg-orange-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Mis Pedidos
            </a>
        @endauth
    </nav>
</div>

@section('scripts')
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const iconOpen = document.getElementById('icon-open');
        const iconClose = document.getElementById('icon-close');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            iconOpen.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        });
    </script>
@endsection
