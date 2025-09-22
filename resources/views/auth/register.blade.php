@extends('layouts.app')

@section('titulo', 'Iniciar Sesión')

@section('contenido')
    <div class="flex items-center justify-center my-15 px-3">
        <div class="w-full max-w-md">
            <h1 class="text-center text-2xl font-bold mb-1">Regístrate</h1>
            <p class="text-sm text-gray-600 text-center mb-6">Por favor, ingresa tus datos para crear tu cuenta.</p>

            <form class="w-full" action="{{ route('register.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block mb-2 font-medium text-sm">
                            Nombres
                        </label>
                        <input 
                            id="name"
                            name="name"
                            type="text"
                            placeholder="Pedro Cesar"
                            class="w-full text-sm border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('name') border-red-500 @enderror"
                            value="{{ old('name') }}"
                        />
                        @error('name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div class="mb-3">
                        <label for="last_name" class="block mb-2 font-medium text-sm">
                            Apellidos
                        </label>
                        <input 
                            id="last_name" 
                            name="last_name"
                            type="name"
                            placeholder="San Julio"
                            value="{{ old('last_name') }}"
                            class="w-full text-sm border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('last_name') border-red-500 @enderror"
                        />
                        @error('last_name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="dni" class="block mb-2 font-medium text-sm">
                            DNI
                        </label>
                        <input 
                            id="dni"
                            name="dni"
                            type="text"
                            placeholder="60606060"
                            value="{{ old('dni') }}"
                            class="w-full text-sm border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('dni') border-red-500 @enderror"
                        />
                        @error('dni')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div class="mb-3">
                        <label for="phone" class="block mb-2 font-medium text-sm">
                            Teléfono
                        </label>
                        <input 
                            id="phone" 
                            name="phone"
                            type="tel"
                            placeholder="987654321"
                            value="{{ old('phone') }}"
                            class="w-full text-sm border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('phone') border-red-500 @enderror"
                        />
                        @error('phone')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="block mb-2 font-medium text-sm">
                        Correo electrónico
                    </label>
                    <input 
                        id="email"
                        name="email"
                        type="text"
                        placeholder="correo@correo.com"
                        value="{{ old('email') }}"
                        class="w-full text-sm border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('email') border-red-500 @enderror"
                    />
                    @error('email')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="block mb-2 font-medium text-sm">
                        Contraseña
                    </label>
                    <input 
                        id="password" 
                        name="password"
                        type="password"
                        placeholder="******"
                        class="w-full text-sm border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('email') border-red-500 @enderror"
                    />
                    @error('password')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="block mb-2 font-medium text-sm">
                        Confirmar Contraseña
                    </label>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        placeholder="******"
                        class="w-full text-sm border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
                    />
                </div>

                <div class="flex flex-col md:flex-row">
                    <button
                        type="submit"
                        class="text-sm font-medium shadow mt-3 w-full bg-orange-500 text-white py-2.5 rounded-lg hover:bg-orange-600 transition-colors duration-300 cursor-pointer"
                    >
                        Registrar Cuenta
                    </button>

                    <a href="{{ route('login') }}" class="text-sm ml-0 md:ml-4 font-medium shadow-2xl text-center mt-3 w-full bg-gray-300 py-2.5 rounded-lg hover:bg-gray-400 transition-colors duration-300 cursor-pointer">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection