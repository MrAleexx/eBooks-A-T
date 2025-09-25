@extends('layouts.app')

@section('titulo', $book->title . ' - Grupo A&T')

@section('contenido')
    <section class="container mx-auto px-4 sm:px-6 py-6 md:py-8 lg:py-10">
        <!-- Header del libro -->
        <div class="max-w-6xl mx-auto">
            <!-- Información principal del libro -->
            <div class="bg-white rounded-2xl shadow-sm border border-[#272b30]/10 p-6 md:p-8 mb-8">
                <div class="grid grid-cols-1 lg:grid-cols-[280px_1fr] gap-6 md:gap-8">
                    <!-- Imagen del libro -->
                    <div class="flex justify-center lg:justify-start">
                        <div class="relative">
                            <x-book-image :image="$book->image" :title="$book->title"
                                class="w-48 h-64 md:w-56 md:h-72 lg:w-64 lg:h-80 object-cover rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300" />
                            @if ($book->is_new)
                                <span
                                    class="absolute top-3 left-3 bg-[#ea9216] text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                    ¡NUEVO!
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Información del libro -->
                    <div class="flex flex-col justify-between">
                        <div>
                            <div class="mb-4">
                                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#04050E] leading-tight mb-2">
                                    {{ $book->title }}
                                </h1>
                                <p class="text-[#272b30]/80 text-lg md:text-xl">por {{ $book->author }}</p>
                            </div>

                            <!-- Precio y etiquetas -->
                            <div class="mb-6">
                                <div class="flex items-center gap-4 mb-3">
                                    <span class="text-3xl md:text-4xl font-bold text-[#ea9216]">
                                        S/ {{ number_format($book->price, 2) }}
                                    </span>
                                    @if ($book->is_new)
                                        <span
                                            class="bg-[#ea9216]/10 text-[#ea9216] px-3 py-1 rounded-full text-sm font-semibold">
                                            Novedad
                                        </span>
                                    @endif
                                </div>
                                <p class="text-[#272b30]/60 text-sm">Incluye IGV según Ley N.° 31893</p>
                            </div>

                            <!-- Formulario de compra -->
                            <form action="{{ route('cart.add', $book) }}" method="POST" class="mb-6">
                                @csrf
                                <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                                    <div class="flex items-center gap-3">
                                        <label class="text-[#04050E] font-semibold text-sm">Cantidad:</label>
                                        <div
                                            class="flex items-center border border-[#272b30]/20 rounded-lg overflow-hidden">
                                            <button type="button" onclick="decrementQuantity()"
                                                class="w-10 h-10 flex items-center justify-center bg-[#272b30]/5 hover:bg-[#272b30]/10 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M20 12H4" />
                                                </svg>
                                            </button>
                                            <input type="number" id="quantity" name="quantity" value="1"
                                                min="1" max="5"
                                                class="w-16 h-10 text-center border-0 focus:ring-2 focus:ring-[#ea9216]/20 font-semibold">
                                            <button type="button" onclick="incrementQuantity()"
                                                class="w-10 h-10 flex items-center justify-center bg-[#272b30]/5 hover:bg-[#272b30]/10 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 4v16m8-8H4" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="bg-gradient-to-r from-[#ea9216] to-[#d88310] hover:from-[#d88310] hover:to-[#ea9216] text-white font-bold px-6 py-3 rounded-lg transition-all duration-300 hover:shadow-lg transform hover:-translate-y-0.5 flex items-center gap-2 shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        AÑADIR AL CARRITO
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Acciones secundarias -->
                        <div class="flex flex-wrap gap-4 text-sm">
                            <button onclick="shareBook()"
                                class="flex items-center gap-2 text-[#052f5a] hover:text-[#041f3f] transition-colors font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                                Compartir
                            </button>
                            <button onclick="addToWishlist()"
                                class="flex items-center gap-2 text-[#052f5a] hover:text-[#041f3f] transition-colors font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                Guardar en favoritos
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navegación de pestañas -->
            <div class="bg-white rounded-2xl shadow-sm border border-[#272b30]/10 mb-8">
                <div class="border-b border-[#272b30]/10">
                    <nav class="flex overflow-x-auto">
                        <button id="tab-info"
                            class="tab-button active px-6 py-4 font-semibold text-[#04050E] border-b-2 border-[#ea9216] whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Información General
                        </button>
                        <button id="tab-details"
                            class="tab-button px-6 py-4 font-semibold text-[#272b30]/60 hover:text-[#04050E] whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Detalles del Producto
                        </button>
                        <button id="tab-index"
                            class="tab-button px-6 py-4 font-semibold text-[#272b30]/60 hover:text-[#04050E] whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            Índice General
                        </button>
                    </nav>
                </div>

                <!-- Contenido de pestañas -->
                <div class="p-6 md:p-8">
                    <!-- Pestaña Información General -->
                    <div id="content-info" class="tab-content active">
                        <div class="prose max-w-none">
                            <h3 class="text-xl font-bold text-[#04050E] mb-4">Resumen</h3>
                            <p class="text-[#272b30]/80 leading-relaxed">{{ $book->description }}</p>
                        </div>
                    </div>

                    <!-- Pestaña Detalles del Producto -->
                    <div id="content-details" class="tab-content hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex justify-between py-2 border-b border-[#272b30]/10">
                                    <span class="text-[#272b30]/60">Autor:</span>
                                    <strong class="text-[#04050E]">{{ $book->author }}</strong>
                                </div>
                                <div class="flex justify-between py-2 border-b border-[#272b30]/10">
                                    <span class="text-[#272b30]/60">Editorial:</span>
                                    <strong class="text-[#04050E]">{{ $book->editorial }}</strong>
                                </div>
                                <div class="flex justify-between py-2 border-b border-[#272b30]/10">
                                    <span class="text-[#272b30]/60">Formato:</span>
                                    <strong class="text-[#04050E]">{{ $book->format }}</strong>
                                </div>
                                <div class="flex justify-between py-2 border-b border-[#272b30]/10">
                                    <span class="text-[#272b30]/60">Páginas:</span>
                                    <strong class="text-[#04050E]">{{ $book->pages }}</strong>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex justify-between py-2 border-b border-[#272b30]/10">
                                    <span class="text-[#272b30]/60">ISBN:</span>
                                    <strong class="text-[#04050E]">{{ $book->isbn }}</strong>
                                </div>
                                <div class="flex justify-between py-2 border-b border-[#272b30]/10">
                                    <span class="text-[#272b30]/60">Dimensiones:</span>
                                    <strong class="text-[#04050E]">24.0 × 17.0 cm</strong>
                                </div>
                                <div class="flex justify-between py-2 border-b border-[#272b30]/10">
                                    <span class="text-[#272b30]/60">Peso:</span>
                                    <strong class="text-[#04050E]">0.5 kg</strong>
                                </div>
                                <div class="flex justify-between py-2 border-b border-[#272b30]/10">
                                    <span class="text-[#272b30]/60">Categoría:</span>
                                    <strong class="text-[#04050E]">Educación</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pestaña Índice General -->
                    <div id="content-index" class="tab-content hidden">
                        <h3 class="text-xl font-bold text-[#04050E] mb-6">Índice General</h3>
                        <div class="space-y-3 text-sm md:text-base">
                            <div class="font-semibold text-[#052f5a]">Créditos</div>
                            <div class="font-semibold text-[#052f5a]">Dedicatoria</div>
                            <div class="font-semibold text-[#052f5a]">Autores</div>
                            <div class="font-semibold text-[#052f5a]">Presentación</div>
                            <div class="font-semibold text-[#052f5a]">Índice General</div>

                            <!-- Capítulos principales -->
                            <div class="ml-4 space-y-2 mt-4">
                                @foreach (['1. Ingresando a trabajar con ChatGPT', '2. ¿Qué es un Prompt?', '3. ¿Qué es un Prompt Maestro?', '4. Cómo usar los prompts en ChatGPT'] as $chapter)
                                    <div class="flex items-center gap-2 text-[#04050E]">
                                        <span class="w-2 h-2 bg-[#ea9216] rounded-full"></span>
                                        {{ $chapter }}
                                    </div>
                                @endforeach

                                <!-- Nivel Inicial -->
                                <div class="mt-3">
                                    <div class="flex items-center gap-2 font-semibold text-[#052f5a]">
                                        <span class="w-2 h-2 bg-[#052f5a] rounded-full"></span>
                                        5. Nivel Inicial
                                    </div>
                                    <div class="ml-6 space-y-2 mt-2">
                                        <div>Banco de Prompts por Áreas Curriculares (140)</div>
                                        <div class="ml-4 grid grid-cols-1 md:grid-cols-2 gap-1">
                                            @foreach (['Personal Social', 'Psicomotriz', 'Comunicación', 'Castellano como Segunda Lengua', 'Descubrimiento del Mundo', 'Matemática', 'Ciencia y Tecnología'] as $area)
                                                <div class="flex items-center gap-2">
                                                    <span class="w-1.5 h-1.5 border border-[#272b30] rounded-full"></span>
                                                    {{ $area }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Libros relacionados (placeholder) -->
            <div class="bg-white rounded-2xl shadow-sm border border-[#272b30]/10 p-6 md:p-8">
                <h3 class="text-xl font-bold text-[#04050E] mb-6">Libros Relacionados</h3>
                <div class="text-center py-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#272b30]/30 mx-auto mb-4"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <p class="text-[#272b30]/60">Próximamente más libros de la colección</p>
                </div>
            </div>
        </div>
    </section>

    <style>
        .tab-button {
            transition: all 0.3s ease;
            border-bottom: 2px solid transparent;
        }

        .tab-button.active {
            color: #04050E;
            border-bottom-color: #ea9216;
        }

        .tab-content {
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Scroll personalizado para navegación de pestañas */
        .flex.overflow-x-auto::-webkit-scrollbar {
            height: 4px;
        }

        .flex.overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 2px;
        }

        .flex.overflow-x-auto::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 2px;
        }
    </style>

    <script>
        // Control de cantidad
        function incrementQuantity() {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) < 5) {
                input.value = parseInt(input.value) + 1;
            }
        }

        function decrementQuantity() {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        // Sistema de pestañas
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', function() {
                // Remover clase active de todos los botones
                document.querySelectorAll('.tab-button').forEach(btn => {
                    btn.classList.remove('active');
                    btn.classList.add('text-[#272b30]/60');
                });

                // Añadir clase active al botón clickeado
                this.classList.add('active');
                this.classList.remove('text-[#272b30]/60');

                // Ocultar todos los contenidos
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.add('hidden');
                    content.classList.remove('active');
                });

                // Mostrar contenido correspondiente
                const contentId = this.id.replace('tab-', 'content-');
                document.getElementById(contentId).classList.remove('hidden');
                document.getElementById(contentId).classList.add('active');
            });
        });

        // Compartir libro
        function shareBook() {
            if (navigator.share) {
                navigator.share({
                        title: '{{ $book->title }}',
                        text: 'Mira este libro: {{ $book->title }} por {{ $book->author }}',
                        url: window.location.href,
                    })
                    .catch(console.error);
            } else {
                // Fallback para copiar enlace
                navigator.clipboard.writeText(window.location.href);
                alert('Enlace copiado al portapapeles');
            }
        }

        // Añadir a favoritos
        function addToWishlist() {
            // Simular añadir a favoritos
            alert('Libro añadido a tus favoritos');
        }

        // Efectos de hover en imágenes
        document.addEventListener('DOMContentLoaded', function() {
            const bookImage = document.querySelector('x-book-image');
            if (bookImage) {
                bookImage.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.02)';
                });
                bookImage.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            }
        });
    </script>
@endsection
