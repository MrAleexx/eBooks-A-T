@extends('layouts.app')

@section('titulo', 'Inicio - Grupo A&T - Libros Digitales')

@section('contenido')
    <!-- Hero Section Mejorada -->
    <section class="relative w-full h-[70vh] min-h-[500px] bg-gray-900 overflow-hidden">
        <!-- Imagen de fondo con overlay -->
        <div class="absolute inset-1">
            <img src="{{ asset('img/fondo_books.jpg') }}" alt="Biblioteca digital Grupo A&T"
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-[#04050E]/80 to-[#272b30]/60"></div>
        </div>

        <!-- Contenido Hero -->
        <div class="relative container mx-auto h-full flex items-center px-4">
            <div class="max-w-2xl text-white">
                <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight">
                    Descubre el <span class="text-[#ea9216]">conocimiento</span> que transforma
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-gray-200">
                    Libros digitales educativos para tu crecimiento personal y profesional
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('homebook') }}"
                        class="bg-[#ea9216] hover:bg-[#d48314] text-white px-8 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                        Explorar Libros
                    </a>
                    <a href="{{ route('homeabout') }}"
                        class="border-2 border-white text-white hover:bg-white hover:text-gray-900 px-8 py-3 rounded-lg font-semibold transition-all duration-300 text-center">
                        Conócenos
                    </a>
                </div>
            </div>
        </div>

        <!-- Indicador de scroll -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
            <div class="animate-bounce">
                <i class="fas fa-chevron-down text-white text-2xl"></i>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="p-6">
                    <div class="text-3xl font-bold text-[#052f5a] mb-2" id="booksCount">0</div>
                    <p class="text-gray-600">Libros Disponibles</p>
                </div>
                <div class="p-6">
                    <div class="text-3xl font-bold text-[#052f5a] mb-2" id="categoriesCount">0</div>
                    <p class="text-gray-600">Categorías</p>
                </div>
                <div class="p-6">
                    <div class="text-3xl font-bold text-[#052f5a] mb-2" id="clientsCount">0</div>
                    <p class="text-gray-600">Clientes Satisfechos</p>
                </div>
                <div class="p-6">
                    <div class="text-3xl font-bold text-[#052f5a] mb-2" id="experienceCount">0</div>
                    <p class="text-gray-600">Años de Experiencia</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Libro Destacado Section -->
    <!-- Libro Destacado Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-[#ea9216] font-semibold uppercase tracking-wider text-sm">Destacado</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Libro en Tendencia</h2>
                <p class="text-gray-600 max-w-2xl mx-auto mt-4">
                    Descubre nuestro libro más popular del momento
                </p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-r from-[#052f5a] to-[#272b30] rounded-2xl p-8 md:p-12 shadow-2xl">
                    <div class="grid md:grid-cols-2 gap-8 items-center">
                        <!-- Imagen del libro -->
                        <div class="relative group">
                            <div class="relative z-10 transform group-hover:scale-105 transition-transform duration-500">
                                <x-book-image :image="$book->image" :title="$book->title" class="w-full rounded-xl shadow-2xl" />
                            </div>
                            <div
                                class="absolute inset-0 bg-[#ea9216] rounded-xl transform rotate-3 scale-105 opacity-20 group-hover:rotate-6 transition-transform duration-500">
                            </div>
                        </div>

                        <!-- Información del libro -->
                        <div class="text-white">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="bg-[#ea9216] text-white px-3 py-1 rounded-full text-sm font-semibold">
                                    🔥 Más Vendido
                                </span>
                                <span class="bg-white/20 px-3 py-1 rounded-full text-sm">
                                    {{ $book->category->name ?? 'Educación' }}
                                </span>
                            </div>

                            <h3 class="text-2xl md:text-3xl font-bold mb-4 leading-tight">
                                {{ $book->title }}
                            </h3>

                            <p class="text-gray-200 mb-6 line-clamp-3">
                                {{ $book->description ?? 'Descubre este increíble libro que está transformando la manera de aprender.' }}
                            </p>

                            <div class="flex items-center gap-4 mb-6">
                                <div class="text-3xl font-bold text-[#ea9216]">
                                    S/ {{ number_format($book->price, 2) }}
                                </div>
                                @if (isset($book->price_original) && $book->price_original > $book->price)
                                    <div class="text-lg text-gray-300 line-through">
                                        S/ {{ number_format($book->price_original, 2) }}
                                    </div>
                                @endif
                            </div>

                            <!-- BOTONES MODIFICADOS - Ahora redirigen al detalle -->
                            <div class="flex flex-col sm:flex-row gap-3">
                                @auth
                                    <!-- Usuario autenticado: Ver detalles -->
                                    <a href="{{ route('bookmart.book', ['book' => $book->id]) }}"
                                        class="flex-1 bg-[#ea9216] hover:bg-[#d48314] text-white py-3 px-6 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 text-center">
                                        <i class="fas fa-eye"></i>
                                        Ver Detalles
                                    </a>
                                @else
                                    <!-- Usuario no autenticado: Ver detalles -->
                                    <a href="{{ route('bookmart.book', ['book' => $book->id]) }}"
                                        class="flex-1 bg-[#ea9216] hover:bg-[#d48314] text-white py-3 px-6 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 text-center">
                                        <i class="fas fa-eye"></i>
                                        Ver Detalles
                                    </a>
                                @endauth

                                <!-- Botón secundario para explorar más libros -->
                                <a href="{{ route('homebook') }}"
                                    class="bg-white/10 hover:bg-white/20 text-white py-3 px-6 rounded-lg font-semibold transition-all duration-300 text-center border border-white/20 flex items-center justify-center gap-2">
                                    <i class="fas fa-search"></i>
                                    Explorar Más
                                </a>
                            </div>

                            <!-- Características rápidas -->
                            <div class="grid grid-cols-2 gap-4 mt-6 pt-6 border-t border-white/20">
                                <div class="flex items-center gap-2 text-sm">
                                    <i class="fas fa-file-pdf text-[#ea9216]"></i>
                                    <span>Formato PDF</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm">
                                    <i class="fas fa-download text-[#ea9216]"></i>
                                    <span>Descarga Inmediata</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-[#04050E] to-[#272b30]">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                ¿Listo para comenzar tu viaje de aprendizaje?
            </h2>
            <p class="text-gray-200 text-lg mb-8 max-w-2xl mx-auto">
                Explora nuestra completa colección de libros digitales y lleva tu conocimiento al siguiente nivel.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('homebook') }}"
                    class="bg-[#ea9216] hover:bg-[#d48314] text-white px-8 py-4 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Ver Todos los Libros
                </a>
                <a href="{{ route('homecontact') }}"
                    class="border-2 border-white text-white hover:bg-white hover:text-gray-900 px-8 py-4 rounded-lg font-semibold transition-all duration-300">
                    Contáctanos
                </a>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="bg-gray-50 rounded-2xl p-8 md:p-12 text-center">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                    Mantente Informado
                </h2>
                <p class="text-gray-600 mb-6">
                    Suscríbete para recibir las últimas novedades, promociones exclusivas y nuevos lanzamientos.
                </p>
                <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                    <input type="email" placeholder="Tu correo electrónico"
                        class="flex-grow px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#ea9216] focus:border-transparent">
                    <button type="submit"
                        class="bg-[#ea9216] hover:bg-[#d48314] text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-300 flex items-center justify-center gap-2">
                        Suscribirse
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // Animación de contadores
        document.addEventListener('DOMContentLoaded', function() {
            // Configuración de contadores (puedes obtener estos valores de tu base de datos)
            const counters = [{
                    id: 'booksCount',
                    target: 150,
                    suffix: '+'
                },
                {
                    id: 'categoriesCount',
                    target: 12,
                    suffix: '+'
                },
                {
                    id: 'clientsCount',
                    target: 2500,
                    suffix: '+'
                },
                {
                    id: 'experienceCount',
                    target: 5,
                    suffix: '+'
                }
            ];

            function animateCounter(counter, duration = 2000) {
                const element = document.getElementById(counter.id);
                const start = 0;
                const increment = counter.target / (duration / 16);
                let current = start;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= counter.target) {
                        clearInterval(timer);
                        current = counter.target;
                    }
                    element.textContent = Math.floor(current) + (counter.suffix || '');
                }, 16);
            }

            // Activar animación cuando la sección sea visible
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        counters.forEach(counter => animateCounter(counter));
                        observer.unobserve(entry.target);
                    }
                });
            });

            const statsSection = document.querySelector('.bg-gray-50');
            if (statsSection) {
                observer.observe(statsSection);
            }

            // Smooth scroll para el indicador del hero
            document.querySelector('.fa-chevron-down').addEventListener('click', function() {
                document.querySelector('.bg-gray-50').scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>

    <style>
        /* Estilos adicionales */
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Mejoras de animación */
        .transform {
            transition: transform 0.3s ease;
        }

        /* Efectos hover mejorados */
        .hover\:scale-105:hover {
            transform: scale(1.05);
        }
    </style>
@endsection
