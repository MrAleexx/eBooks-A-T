@props([
    'method' => 'yape',
    'accountInfo' => '',
    'action' => route('cart.process'),
    'buttonText' => 'Confirmar Pedido',
])

<div class="bg-[#eeeeee] rounded-lg shadow p-6">
    <h3 class="text-xl font-semibold mb-4 text-[#04050E]">Método de Pago</h3>

    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="payment_method" value="{{ $method }}">

        @if ($accountInfo)
            <div class="mb-4 p-3 bg-[#052f5a] text-[#eeeeee] rounded-md">
                {!! $accountInfo !!}
            </div>
        @endif

        <div class="mb-4">
            <label class="block text-[#04050E] mb-2 font-medium">Subir comprobante de pago:
                <input type="file" name="voucher" accept="image/*"
                    class="w-full border border-[#272b30]/30 rounded-md p-2 focus:border-[#ea9216] focus:ring focus:ring-[#ea9216]/20 transition-colors">
            </label>
            <p class="text-sm text-[#272b30]/60 mt-1">Formatos aceptados: JPEG, PNG, JPG, GIF (Max: 2MB)</p>
            @error('voucher')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full bg-[#ea9216] hover:bg-[#d88310] text-[#04050E] font-semibold py-3 px-4 rounded-md transition-colors duration-300 hover:shadow-lg">
            {{ $buttonText }}
        </button>
    </form>
</div>
