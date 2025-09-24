@props([
    'method' => 'yape',
    'accountInfo' => '',
    'action' => route('cart.process'),
    'buttonText' => 'Confirmar Pedido',
    'methodName' => 'Yape',
])

<div class="bg-white rounded-2xl shadow-lg border border-[#272b30]/10 p-6">
    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-[#272b30]/10">
        <div class="w-12 h-12 bg-gradient-to-r from-[#052f5a] to-[#041f3f] rounded-lg flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
            </svg>
        </div>
        <div>
            <h3 class="text-xl font-bold text-[#04050E]">Pago con {{ $methodName }}</h3>
            <p class="text-[#272b30]/60 text-sm">Confirma tu pedido subiendo el comprobante</p>
        </div>
    </div>

    @if ($accountInfo)
        <div class="mb-6 p-4 bg-gradient-to-r from-[#052f5a] to-[#041f3f] text-white rounded-lg">
            <h4 class="font-semibold mb-2">Información de la cuenta:</h4>
            <div class="text-sm">{!! $accountInfo !!}</div>
        </div>
    @endif

    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="payment_method" value="{{ $method }}">

        <div class="mb-6">
            <label class="block text-[#04050E] font-semibold mb-3">Comprobante de pago

                <div
                    class="border-2 border-dashed border-[#272b30]/20 rounded-xl p-6 text-center hover:border-[#ea9216] transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#272b30]/40 mx-auto mb-3"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>

                    <input type="file" name="voucher" accept="image/*"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>

                    <p class="text-[#272b30]/60 mb-1">Haz clic para subir tu comprobante</p>
                    <p class="text-[#272b30]/40 text-xs">Formatos: JPEG, PNG, JPG, GIF (Máx. 2MB)</p>
                </div>
                @error('voucher')
                    <p class="text-red-600 text-sm mt-2 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </label>
        </div>

        <button type="submit"
            class="w-full bg-gradient-to-r from-[#ea9216] to-[#d88310] hover:from-[#d88310] hover:to-[#ea9216] text-[#04050E] font-bold py-4 px-6 rounded-xl transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">
            {{ $buttonText }}
        </button>
    </form>

    <!-- Información de seguridad -->
    <div class="mt-4 pt-4 border-t border-[#272b30]/10">
        <div class="flex items-center justify-center gap-2 text-[#272b30]/60 text-xs">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
            <span>Transacción segura y encriptada</span>
        </div>
    </div>
</div>
