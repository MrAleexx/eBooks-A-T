@extends('layouts.app')

@section('titulo', 'Mis Pedidos')

@section('contenido')
    <section class="container mx-auto px-4 py-8">
        <!-- Header mejorado -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-clipboard-list text-orange-500 mr-3"></i> Mis Pedidos
                </h1>
                <p class="text-gray-600 mt-2">Revisa el estado de todos tus pedidos realizados</p>
            </div>
            <a href="{{ route('homebook') }}"
                class="mt-4 md:mt-0 bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-lg font-medium transition-colors duration-300 flex items-center">
                <i class="fas fa-store mr-2"></i> Seguir comprando
            </a>
        </div>

        <!-- Estadísticas resumen -->
        @if ($orders->count() > 0)
            @php
                $completed = $orders->where('status', 'paid')->count();
                $pending = $orders->where('status', 'pending')->count();
                $total = $orders->sum(function ($order) {
                    return $order->orderDetails->sum('subtotal');
                });
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-orange-500">
                    <div class="text-gray-500 text-sm">Total Pedidos</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $orders->count() }}</div>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-blue-500">
                    <div class="text-gray-500 text-sm">Pendientes</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $pending }}</div>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-green-500">
                    <div class="text-gray-500 text-sm">Completados</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $completed }}</div>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-purple-500">
                    <div class="text-gray-500 text-sm">Gasto Total</div>
                    <div class="text-2xl font-bold text-gray-800">S/ {{ number_format($total, 2) }}</div>
                </div>
            </div>
        @endif

        @if ($orders->count() > 0)
            <!-- Lista de pedidos -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <!-- Encabezados de tabla (solo desktop) -->
                <div class="hidden md:grid grid-cols-12 gap-4 bg-gray-50 px-6 py-4 text-gray-600 font-medium text-sm">
                    <div class="col-span-2">N° PEDIDO</div>
                    <div class="col-span-2">FECHA</div>
                    <div class="col-span-4">PRODUCTOS</div>
                    <div class="col-span-2">ESTADO</div>
                    <div class="col-span-2 text-right">TOTAL</div>
                </div>

                <!-- Items de pedido -->
                <div class="divide-y divide-gray-100">
                    @foreach ($orders as $order)
                        @php
                            $itemsCount = $order->orderDetails->sum('quantity');
                            $firstProduct = $order->orderDetails->first()->book->title ?? 'Producto no disponible';
                        @endphp

                        <div class="order-card bg-white px-6 py-5 hover:bg-gray-50 transition-colors duration-200">
                            <a href="{{ route('orders.show', $order) }}">
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                                    <div class="col-span-2">
                                        <div class="text-gray-500 text-xs md:hidden font-medium mb-1">N° Pedido</div>
                                        <div class="font-semibold text-orange-600">#{{ $order->id }}</div>
                                    </div>
                                    <div class="col-span-2">
                                        <div class="text-gray-500 text-xs md:hidden font-medium mb-1">Fecha</div>
                                        <div>{{ $order->created_at->format('d/m/Y') }}</div>
                                        <div class="text-xs text-gray-500">{{ $order->created_at->format('h:i A') }}</div>
                                    </div>
                                    <div class="col-span-4">
                                        <div class="text-gray-500 text-xs md:hidden font-medium mb-1">Productos</div>
                                        <div class="flex items-center">
                                            <span
                                                class="bg-orange-100 text-orange-800 rounded-full px-3 py-1 text-xs font-medium mr-3">
                                                {{ $itemsCount }} {{ $itemsCount === 1 ? 'producto' : 'productos' }}
                                            </span>
                                            <span class="text-sm text-gray-700 truncate">
                                                {{ Illuminate\Support\Str::limit($firstProduct, 35) }}
                                                @if ($itemsCount > 1)
                                                    + {{ $itemsCount - 1 }} más
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-span-2">
                                        <div class="text-gray-500 text-xs md:hidden font-medium mb-1">Estado</div>
                                        <span
                                            class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                    @if ($order->status == 'paid') bg-green-100 text-green-800
                                    @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                            @if ($order->status == 'paid')
                                                <i class="fas fa-check-circle mr-1.5"></i> Pagado
                                            @elseif($order->status == 'pending')
                                                <i class="fas fa-clock mr-1.5"></i> Pendiente
                                            @else
                                                <i class="fas fa-times-circle mr-1.5"></i> Cancelado
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-span-2">
                                        <div class="text-gray-500 text-xs md:hidden font-medium mb-1">Total</div>
                                        <div class="text-right font-bold text-orange-600">S/
                                            {{ number_format($order->orderDetails->sum('subtotal'), 2) }}</div>
                                    </div>
                                </div>
                            </a>

                            <div
                                class="flex flex-col md:flex-row justify-between items-start md:items-center mt-4 pt-4 border-t border-gray-100">
                                <div class="text-sm text-gray-500 mb-3 md:mb-0">
                                    <i class="fas fa-credit-card mr-1.5"></i>
                                    {{ isset($order->payment) ? ucfirst(str_replace('_', ' ', $order->payment->payment_method)) : 'Método no especificado' }}
                                </div>
                                <div class="flex space-x-3">
                                    <a href="{{ route('orders.show', $order) }}"
                                        class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                        <i class="fas fa-eye mr-1.5"></i> Ver detalle
                                    </a>
                                    @if ($order->status == 'paid')
                                        <button
                                            class="text-sm text-orange-600 hover:text-orange-800 font-medium flex items-center"
                                            onclick="event.preventDefault(); document.getElementById('repeat-order-{{ $order->id }}').submit();">
                                            <i class="fas fa-redo-alt mr-1.5"></i> Repetir pedido
                                        </button>
                                        <form id="repeat-order-{{ $order->id }}"
                                            action="{{ route('orders.repeat', $order) }}" method="POST" class="hidden">
                                            @csrf
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Paginación -->
            @if ($orders->hasPages())
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @endif
        @else
            <!-- Estado vacío -->
            <div class="text-center py-16 bg-white rounded-xl shadow border border-gray-100">
                <div class="bg-orange-50 rounded-full p-5 w-24 h-24 mx-auto flex items-center justify-center">
                    <i class="fas fa-clipboard-list text-orange-500 text-4xl"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-800 mt-6">No tienes pedidos aún</h3>
                <p class="text-gray-600 mt-3 max-w-md mx-auto">Cuando realices tu primera compra, podrás ver el detalle de
                    todos tus pedidos aquí.</p>
                <a href="{{ route('homebook') }}"
                    class="inline-block mt-6 bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-300 shadow-md hover:shadow-lg">
                    <i class="fas fa-book mr-2"></i> Explorar libros
                </a>
            </div>
        @endif
    </section>

    <!-- Sección de soporte -->
    <section class="container mx-auto px-4 pb-12">
        <div class="bg-gradient-to-r from-orange-50 to-amber-50 rounded-xl p-6 border border-orange-200">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center mb-4 md:mb-0">
                    <div class="bg-orange-100 rounded-full p-3 mr-4">
                        <i class="fas fa-headset text-orange-600 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">¿Necesitas ayuda con tu pedido?</h3>
                        <p class="text-gray-600 text-sm">Nuestro equipo de soporte está disponible para ayudarte</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="https://wa.me/51942784270?text=Hola,%20necesito%20ayuda%20con%20mis%20pedidos" target="_blank"
                        class="bg-white text-orange-600 border border-orange-600 px-4 py-2 rounded-lg font-medium hover:bg-orange-50 transition-colors">
                        <i class="fab fa-whatsapp mr-2"></i> Chatear
                    </a>
                    <a href="mailto:alextaya@hotmail.com"
                        class="bg-orange-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-orange-700 transition-colors">
                        <i class="fas fa-envelope mr-2"></i> Email
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style>
        .order-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #f97316;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
        }
    </style>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush
