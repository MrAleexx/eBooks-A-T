@extends('layouts.app')

@section('titulo', 'Iniciar Sesión')

@section('contenido')
    <div class="flex items-center justify-center my-15 px-3">
        <div class="w-full max-w-md">
            <h1 class="text-center text-2xl font-bold">Iniciar Sesión</h1>

            <form class="w-full mt-4" action="{{ route('login.store') }}" method="POST">
                @csrf
                @if (session('mensaje'))
                    <p id="message" class="bg-red-500 text-white mb-3 rounded-lg text-sm p-2 text-center">
                        {{ session('mensaje') }}</p>
                    <script>
                        setTimeout(() => {
                            const message = document.getElementById('message');
                            if (message) {
                                message.remove();
                            }
                        }, 2000);
                    </script>
                @endif

                @if (session('mensaje_correcto'))
                    <p id="message" class="bg-green-500 text-white mb-3 rounded-lg text-sm p-2 text-center">
                        {{ session('mensaje_correcto') }}</p>
                    <script>
                        setTimeout(() => {
                            const mensaje_correcto = document.getElementById('message');
                            if (mensaje_correcto) {
                                mensaje_correcto.remove();
                            }
                        }, 2000);
                    </script>
                @endif
                <div class="mb-5">
                    <label for="email" class="block mb-2 font-medium text-sm">
                        Correo electrónico
                    </label>
                    <input id="email" name="email" type="text" placeholder="correo@correo.com"
                        class="w-full text-sm border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('email') border-red-500 @enderror" />
                    @error('email')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="block mb-2 font-medium text-sm">
                        Contraseña
                    </label>
                    <input id="password" name="password" type="password" placeholder="******"
                        class="w-full text-sm border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('email') border-red-500 @enderror" />
                    @error('password')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <a href="{{ route('password') }}"
                    class="text-sm font-medium hover:text-gray-800 transition-colors duration-300">
                    Olvidaste tu contraseña?
                </a>

                <button type="submit"
                    class="mt-3 w-full bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 transition-colors duration-300 cursor-pointer">
                    Iniciar Sesión
                </button>

                <a href="{{ route('register') }}"
                    class="text-sm font-medium block mt-3 hover:text-gray-800 transition-colors duration-300">
                    ¿No tienes una cuenta? <span
                        class="text-orange-500 font-semibold hover:text-orange-600">Regístrate</span>
                </a>
            </form>
        </div>
    </div>
@endsection
