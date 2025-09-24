@props(['cart', 'total'])

<div class="bg-[#eeeeee] rounded-lg shadow p-6">
    <h3 class="text-xl font-semibold mb-4 text-[#04050E]">Resumen de tu pedido</h3>

    @foreach ($cart as $item)
        <div class="flex justify-between items-center border-b border-[#272b30]/10 py-3">
            <div class="flex items-center">
                <x-book-image :image="$item['image']" :title="$item['title']" class="w-16 h-20 object-cover rounded" />
                <div class="ml-3">
                    <h4 class="font-medium text-[#04050E]">{{ $item['title'] }}</h4>
                    <p class="text-sm text-[#272b30]/80">Cantidad: {{ $item['quantity'] }}</p>
                </div>
            </div>
            <span class="text-[#ea9216] font-bold">S/ {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
        </div>
    @endforeach

    <div class="flex justify-between items-center mt-4 pt-4 border-t border-[#272b30]/10">
        <span class="text-lg font-semibold text-[#04050E]">Total:</span>
        <span class="text-[#ea9216] font-bold text-xl">S/ {{ number_format($total, 2) }}</span>
    </div>
</div>
