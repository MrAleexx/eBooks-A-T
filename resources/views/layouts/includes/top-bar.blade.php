<section class="border-b border-gray-300">
    <div class="container mx-auto flex flex-col items-center md:flex-row md:justify-between">
        <div class="flex text-sm pt-4 md:p-4 items-center">
            <p class="flex gap-1.5 items-center border-r border-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                    stroke="#F7941D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-headset">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 14v-3a8 8 0 1 1 16 0v3" />
                    <path d="M18 19c0 1.657 -2.686 3 -6 3" />
                    <path d="M4 14a2 2 0 0 1 2 -2h1a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-1a2 2 0 0 1 -2 -2v-3z" />
                    <path d="M15 14a2 2 0 0 1 2 -2h1a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-1a2 2 0 0 1 -2 -2v-3z" />
                </svg>
                <span class="mr-2 text-gray-700">942 784 270</span>
            </p>
            <p class="flex gap-1.5 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                    stroke="#F7941D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-message ml-2">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M8 9h8" />
                    <path d="M8 13h6" />
                    <path
                        d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" />
                </svg>
                <span class="text-gray-700">alextaya@hotmail.com</span>
            </p>
        </div>

        <div class="flex text-sm p-4 items-center">
            @auth
                <a href="{{ route('perfil') }}" class="flex gap-1.5 items-center cursor-pointer group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                        stroke="#F7941D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-users group-hover:stroke-orange-500 transition-colors duration-200">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                    </svg>
                    <span
                        class="mr-2 text-gray-700 group-hover:text-gray-900 group-hover:font-medium transition-all duration-200">{{ Auth::user()->name }}</span>
                </a>

                <form action="{{ route('logout.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex gap-1.5 items-center cursor-pointer group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                            fill="none" stroke="#F7941D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-login-2 ml-2 group-hover:stroke-orange-500 transition-colors duration-200">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                            <path d="M3 12h13l-3 -3" />
                            <path d="M13 15l3 -3" />
                        </svg>
                        <span
                            class="text-gray-700 group-hover:text-gray-900 group-hover:font-medium transition-all duration-200">Cerrar
                            Sesión</span>
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="flex gap-1.5 items-center cursor-pointer group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                        stroke="#F7941D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-users group-hover:stroke-orange-500 transition-colors duration-200">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                    </svg>
                    <span
                        class="mr-2 text-gray-700 group-hover:text-gray-900 group-hover:font-medium transition-all duration-200">Mi
                        Cuenta</span>
                </a>

                <a href="{{ route('login') }}" class="flex gap-1.5 items-center cursor-pointer group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                        stroke="#F7941D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-login-2 ml-2 group-hover:stroke-orange-500 transition-colors duration-200">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                        <path d="M3 12h13l-3 -3" />
                        <path d="M13 15l3 -3" />
                    </svg>
                    <span
                        class="text-gray-700 group-hover:text-gray-900 group-hover:font-medium transition-all duration-200">Iniciar
                        Sesión</span>
                </a>
            @endguest
        </div>
    </div>
</section>
