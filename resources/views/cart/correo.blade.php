@extends('layouts.app')

@section('titulo', 'Confirmar Pedido por Correo')

@section('contenido')
    <section class="my-10 container mx-auto px-3">
        <h2 class="text-2xl font-bold mb-6 text-center">Confirmar Pedido por Correo</h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Resumen del pedido -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-4">Resumen de tu pedido</h3>

                @foreach ($cart as $item)
                    <div class="flex justify-between items-center border-b py-3">
                        <div class="flex items-center">
                            <x-book-image :image="$item['image']" :title="$item['title']" class="h-30 object-cover rounded" />
                            <div class="ml-3">
                                <h4 class="font-medium">{{ $item['title'] }}</h4>
                                <p class="text-sm text-gray-600">Cantidad: {{ $item['quantity'] }}</p>
                            </div>
                        </div>
                        <span class="text-orange-600 font-bold">
                            S/ {{ number_format($item['price'] * $item['quantity'], 2) }}
                        </span>
                    </div>
                @endforeach

                <div class="flex justify-between items-center mt-4 pt-4">
                    <span class="text-lg font-semibold">Total:</span>
                    <span class="text-orange-600 font-bold text-xl">
                        S/ {{ number_format($total, 2) }}
                    </span>
                </div>
            </div>

            <!-- Formulario para enviar correo -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-4">Confirmación por Correo</h3>

                <form action="{{ route('cart.enviarCorreo') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700">Usuario:</label>
                        <input type="text" class="w-full border rounded-md p-2 bg-gray-100"
                            value="{{ Auth::user()->name }}" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Correo:</label>
                        <input type="email" class="w-full border rounded-md p-2 bg-gray-100"
                            value="{{ Auth::user()->email }}" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Estado:</label>
                        <input type="text" class="w-full border rounded-md p-2 bg-gray-100"
                            value="Pendiente de confirmación" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Título del primer libro:</label>
                        <input type="text" class="w-full border rounded-md p-2 bg-gray-100"
                            value="{{ $cart[array_key_first($cart)]['title'] }}" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Subir comprobante de pago:</label>
                        <input type="file" name="voucher" accept="image/*" class="w-full border rounded-md p-2" required>
                        <p class="text-sm text-gray-600 mt-1">Formatos aceptados: JPEG, PNG, JPG, GIF (Max: 2MB)</p>
                        @error('voucher')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 px-4 rounded font-semibold">
                        Enviar Pedido por Correo
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
