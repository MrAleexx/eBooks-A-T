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
        <div class="relative container mx-auto h-full flex items-center px-3">
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

    <!-- Publicidad Section - Modificada para banners 1080x1080 -->
    <section class="py-12 bg-gradient-to-br from-gray-50 to-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8">
                <span class="text-[#ea9216] font-semibold uppercase tracking-wider text-sm">Novedad</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Libro Destacado</h2>
                <p class="text-gray-600 max-w-2xl mx-auto mt-4">
                    Conoce nuestro manual más vendido para docentes innovadores
                </p>
            </div>

            <div class="swiper bannerSwiper">
                <div class="swiper-wrapper">
                    <!-- Banner 1 - Manual del Docente Innovador -->
                    <div class="swiper-slide">
                        <div
                            class="bg-white rounded-3xl overflow-hidden shadow-2xl hover:shadow-3xl transition-all duration-300 group">
                            <div class="relative">
                                <img src="{{ asset('img/banners/ad_publi.jpg') }}"
                                    alt="Manual del Docente Innovador - IA Generativa"
                                    class="w-full h-96 object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="bg-[#ea9216] text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                        🔥 Más Vendido
                                    </span>
                                </div>
                                <div class="absolute bottom-4 right-4">
                                    <span class="bg-[#052f5a] text-white px-4 py-2 rounded-lg text-lg font-bold shadow-lg">
                                        S/ 10.00
                                    </span>
                                </div>
                            </div>
                            <div class="p-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">Manual del DOCENTE INNOVADOR</h3>
                                <p class="text-gray-600 mb-4 leading-relaxed">
                                    Aplicando IA Generativa - Incluye banco de 1,440 Prompts Maestros para todos los niveles
                                    educativos.
                                </p>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-users text-[#ea9216] mr-1"></i>
                                        +100 vendidos esta semana
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-clock text-[#052f5a] mr-1"></i>
                                        Oferta limitada
                                    </span>
                                </div>
                                <a href="https://wa.me/51942784270?text=Hola,%20estoy%20interesado%20en%20el%20Manual%20del%20Docente%20Innovador"
                                    target="_blank"
                                    class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white py-3 px-6 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 text-center shadow-lg hover:shadow-xl">
                                    <i class="fab fa-whatsapp text-xl"></i>
                                    Comprar por WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Banner 2 - Contenidos del Libro -->
                    <div class="swiper-slide">
                        <div
                            class="bg-gradient-to-br from-[#052f5a] to-[#04050E] rounded-3xl overflow-hidden shadow-2xl hover:shadow-3xl transition-all duration-300 group">
                            <div class="relative h-96 overflow-hidden">
                                <img src="{{ asset('img/banners/ad_plu2.jpg') }}"
                                    alt="Contenidos del Manual del Docente Innovador"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-black/20"></div>
                                <div class="absolute top-4 left-4">
                                    <span class="bg-[#ea9216] text-white px-4 py-2 rounded-full text-sm font-bold">
                                        📚 1,440 Prompts
                                    </span>
                                </div>
                            </div>
                            <div class="p-8 text-white">
                                <h3 class="text-2xl font-bold mb-4">Contenido Exclusivo</h3>
                                <div class="grid grid-cols-2 gap-3 mb-6">
                                    <div class="flex items-center gap-2 text-sm">
                                        <i class="fas fa-check text-[#ea9216]"></i>
                                        <span>Educación Inicial</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm">
                                        <i class="fas fa-check text-[#ea9216]"></i>
                                        <span>Educación Primaria</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm">
                                        <i class="fas fa-check text-[#ea9216]"></i>
                                        <span>Educación Secundaria</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm">
                                        <i class="fas fa-check text-[#ea9216]"></i>
                                        <span>Básica Alternativa</span>
                                    </div>
                                </div>
                                <p class="text-gray-200 mb-6">
                                    Banco completo de prompts para ChatGPT organizado por áreas curriculares y niveles
                                    educativos.
                                </p>
                                <a href="https://wa.me/51942784270?text=Hola,%20quiero%20más%20información%20sobre%20los%20contenidos%20del%20manual"
                                    target="_blank"
                                    class="w-full bg-[#ea9216] hover:bg-[#d48314] text-white py-3 px-6 rounded-lg font-semibold transition-all duration-300 flex items-center justify-center gap-2 text-center">
                                    <i class="fas fa-info-circle"></i>
                                    Más Información
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Banner 3 - Especificaciones Técnicas -->
                    <div class="swiper-slide">
                        <div
                            class="bg-white rounded-3xl overflow-hidden shadow-2xl hover:shadow-3xl transition-all duration-300 group border-2 border-[#ea9216]/20">
                            <div class="relative h-96 overflow-hidden">
                                <img src="{{ asset('img/banners/ad_publi3.jpg') }}"
                                    alt="Especificaciones del Manual del Docente Innovador"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute top-4 right-4">
                                    <span class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm font-bold">
                                        ⏳ Oferta Limitada
                                    </span>
                                </div>
                            </div>
                            <div class="p-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-4">Información del Producto</h3>
                                <div class="space-y-3 mb-6">
                                    <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                        <span class="text-gray-600">Formato:</span>
                                        <span class="font-semibold text-[#052f5a]">PDF Digital</span>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                        <span class="text-gray-600">ISBN:</span>
                                        <span class="font-semibold text-[#052f5a]">978-612-03-1387-9</span>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                        <span class="text-gray-600">Depósito Legal:</span>
                                        <span class="font-semibold text-[#052f5a]">2025-09348</span>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                        <span class="text-gray-600">Entrega:</span>
                                        <span class="font-semibold text-[#052f5a]">Inmediata vía WhatsApp/Email</span>
                                    </div>
                                </div>
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                                    <p class="text-yellow-800 text-sm text-center">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        Precio de lanzamiento por tiempo limitado
                                    </p>
                                </div>
                                <a href="https://wa.me/51942784270?text=Hola,%20quiero%20comprar%20el%20Manual%20del%20Docente%20Innovador"
                                    target="_blank"
                                    class="w-full bg-[#052f5a] hover:bg-[#041e3a] text-white py-3 px-6 rounded-lg font-semibold transition-all duration-300 flex items-center justify-center gap-2 text-center">
                                    <i class="fas fa-shopping-cart"></i>
                                    Comprar Ahora
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Banner 4 - Autores y Contacto -->
                    <div class="swiper-slide">
                        <div
                            class="bg-gradient-to-br from-[#272b30] to-[#04050E] rounded-3xl overflow-hidden shadow-2xl hover:shadow-3xl transition-all duration-300 group">
                            <div class="relative h-96 overflow-hidden">
                                <img src="{{ asset('img/ing-Taya.jpg') }}" alt="Autores y contacto Grupo A&T"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-4 left-4 text-white">
                                    <h4 class="text-xl font-bold">Ing. Alex Taya</h4>
                                    <p class="text-gray-200">Prof. Tania Urcia</p>
                                </div>
                            </div>
                            <div class="p-8 text-white">
                                <h3 class="text-2xl font-bold mb-4">Contacto Directo</h3>
                                <p class="text-gray-200 mb-6">
                                    Venta directa con los autores. Atención personalizada y soporte post-venta.
                                </p>

                                <div class="space-y-3 mb-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-[#ea9216] rounded-full flex items-center justify-center">
                                            <i class="fab fa-whatsapp"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-300">WhatsApp</p>
                                            <p class="font-semibold">+51 942 784 270</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-[#052f5a] rounded-full flex items-center justify-center">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-300">Email</p>
                                            <p class="font-semibold">envío directo</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-[#1877F2] rounded-full flex items-center justify-center">
                                            <i class="fab fa-facebook-f"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-300">Facebook</p>
                                            <p class="font-semibold">facebook.com/grupoaytperu</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex gap-3">
                                    <a href="https://wa.me/51942784270" target="_blank"
                                        class="flex-1 bg-green-500 hover:bg-green-600 text-white py-3 px-4 rounded-lg font-semibold transition-colors duration-300 flex items-center justify-center gap-2 text-center text-sm">
                                        <i class="fab fa-whatsapp"></i>
                                        WhatsApp
                                    </a>
                                    <a href="https://facebook.com/grupoaytperu" target="_blank"
                                        class="flex-1 bg-[#1877F2] hover:bg-[#1666D6] text-white py-3 px-4 rounded-lg font-semibold transition-colors duration-300 flex items-center justify-center gap-2 text-center text-sm">
                                        <i class="fab fa-facebook-f"></i>
                                        Facebook
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="swiper-pagination mt-8"></div>

                <!-- Navigation -->
                {{-- <div class="swiper-button-next text-[#052f5a]"></div>
                <div class="swiper-button-prev text-[#052f5a]"></div> --}}
            </div>

            <!-- Indicador de oferta especial -->
            <div class="text-center mt-8">
                <div class="inline-flex items-center gap-2 bg-red-50 border border-red-200 rounded-full px-6 py-3">
                    <i class="fas fa-fire text-red-500"></i>
                    <span class="text-red-700 font-semibold">¡Oferta de lanzamiento! Precio especial S/ 10.00 por tiempo
                        limitado</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section Mejorada -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div
                    class="text-center p-6 rounded-xl bg-gradient-to-br from-gray-50 to-white shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-[#052f5a]/10 text-[#052f5a] mb-4">
                        <i class="fas fa-book text-2xl"></i>
                    </div>
                    <div class="text-4xl font-bold text-[#052f5a] mb-2" id="booksCount">0</div>
                    <p class="text-gray-600 font-medium">Libros Disponibles</p>
                </div>
                <div
                    class="text-center p-6 rounded-xl bg-gradient-to-br from-gray-50 to-white shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-[#ea9216]/10 text-[#ea9216] mb-4">
                        <i class="fas fa-tags text-2xl"></i>
                    </div>
                    <div class="text-4xl font-bold text-[#052f5a] mb-2" id="categoriesCount">0</div>
                    <p class="text-gray-600 font-medium">Categorías</p>
                </div>
                <div
                    class="text-center p-6 rounded-xl bg-gradient-to-br from-gray-50 to-white shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-[#04050E]/10 text-[#04050E] mb-4">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <div class="text-4xl font-bold text-[#052f5a] mb-2" id="clientsCount">0</div>
                    <p class="text-gray-600 font-medium">Clientes Satisfechos</p>
                </div>
                <div
                    class="text-center p-6 rounded-xl bg-gradient-to-br from-gray-50 to-white shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-[#272b30]/10 text-[#272b30] mb-4">
                        <i class="fas fa-award text-2xl"></i>
                    </div>
                    <div class="text-4xl font-bold text-[#052f5a] mb-2" id="experienceCount">0</div>
                    <p class="text-gray-600 font-medium">Años de Experiencia</p>
                </div>
            </div>
        </div>
    </section>

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

                            <!-- BOTONES -->
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
    <section class="py-20 bg-gradient-to-r from-[#04050E] via-[#052f5a] to-[#272b30] relative overflow-hidden">
        <!-- Elementos decorativos -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-[#ea9216]/10 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#ea9216]/5 rounded-full translate-x-1/2 translate-y-1/2"></div>

        <div class="container mx-auto px-4 text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
                ¿Listo para comenzar tu <span class="text-[#ea9216]">viaje de aprendizaje</span>?
            </h2>
            <p class="text-gray-200 text-xl mb-10 max-w-3xl mx-auto leading-relaxed">
                Explora nuestra completa colección de libros digitales y lleva tu conocimiento al siguiente nivel. Aprende a
                tu ritmo, en cualquier momento y lugar.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <a href="{{ route('homebook') }}"
                    class="bg-[#ea9216] hover:bg-[#d48314] text-white px-10 py-5 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-3xl text-lg flex items-center gap-3">
                    <i class="fas fa-book-open"></i>
                    Ver Todos los Libros
                </a>
                <a href="{{ route('homecontact') }}"
                    class="border-2 border-white text-white hover:bg-white hover:text-gray-900 px-10 py-5 rounded-xl font-semibold transition-all duration-300 text-lg flex items-center gap-3">
                    <i class="fas fa-headset"></i>
                    Contáctanos
                </a>
            </div>

            <!-- Trust indicators -->
            <div class="flex flex-wrap justify-center gap-8 mt-12 pt-8 border-t border-white/20">
                <div class="flex items-center gap-3 text-white/80">
                    <i class="fas fa-lock text-[#ea9216]"></i>
                    <span>Pago seguro</span>
                </div>
                <div class="flex items-center gap-3 text-white/80">
                    <i class="fas fa-shipping-fast text-[#ea9216]"></i>
                    <span>Descarga inmediata</span>
                </div>
                <div class="flex items-center gap-3 text-white/80">
                    <i class="fas fa-user-shield text-[#ea9216]"></i>
                    <span>Garantía de satisfacción</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section Mejorada -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 max-w-5xl">
            <div
                class="bg-gradient-to-r from-[#052f5a] to-[#04050E] rounded-3xl p-8 md:p-12 text-center text-white relative overflow-hidden">
                <!-- Elemento decorativo -->
                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-[#ea9216]/10 rounded-full -translate-y-1/2 translate-x-1/2">
                </div>

                <div class="relative z-10">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">
                        Mantente <span class="text-[#ea9216]">Informado</span>
                    </h2>
                    <p class="text-gray-200 text-lg mb-8 max-w-2xl mx-auto">
                        Suscríbete para recibir las últimas novedades, promociones exclusivas y nuevos lanzamientos
                        directamente en tu correo.
                    </p>
                    <form class="flex flex-col sm:flex-row gap-4 max-w-2xl mx-auto">
                        <div class="flex-grow">
                            <input type="email" placeholder="Tu correo electrónico"
                                class="w-full px-6 py-4 rounded-xl border-1 focus:outline-none focus:ring-2 focus:ring-[#ea9216] text-white-900">
                        </div>
                        <button type="submit"
                            class="bg-[#ea9216] hover:bg-[#d48314] text-white px-8 py-4 rounded-xl font-semibold transition-colors duration-300 flex items-center justify-center gap-3 shadow-lg hover:shadow-xl">
                            <span>Suscribirse</span>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                    <p class="text-gray-300 text-sm mt-4">
                        📧 No spam, solo contenido de valor. Puedes darte de baja en cualquier momento.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <!-- Swiper JS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        // Inicializar Swiper para el hero
        document.addEventListener('DOMContentLoaded', function() {
            // Hero Swiper
            var heroSwiper = new Swiper('.heroSwiper', {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
            });

            // Banner Swiper
            var bannerSwiper = new Swiper('.bannerSwiper', {
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    }
                }
            });

            // Animación de contadores mejorada
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
            }, {
                threshold: 0.3
            });

            const statsSection = document.querySelector('.bg-white');
            if (statsSection) {
                observer.observe(statsSection);
            }

            // Smooth scroll para el indicador del hero
            document.querySelector('.absolute.bottom-8').addEventListener('click', function() {
                document.querySelector('.bg-gray-50').scrollIntoView({
                    behavior: 'smooth'
                });
            });

            // Efecto parallax para el hero
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const hero = document.querySelector('.heroSwiper');
                if (hero) {
                    hero.style.transform = `translateY(${scrolled * 0.5}px)`;
                }
            });
        });
    </script>

    <style>
        /* Estilos adicionales mejorados */
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

        /* Swiper personalización */
        .swiper-pagination-bullet {
            background: #fff;
            opacity: 0.5;
        }

        .swiper-pagination-bullet-active {
            background: #ea9216;
            opacity: 1;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #ea9216;
            background: rgba(255, 255, 255, 0.2);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            backdrop-filter: blur(10px);
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 20px;
        }

        /* Gradientes personalizados */
        .bg-gradient-custom {
            background: linear-gradient(135deg, #052f5a 0%, #04050E 100%);
        }

        /* Sombras mejoradas */
        .shadow-3xl {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
    </style>
@endsection
