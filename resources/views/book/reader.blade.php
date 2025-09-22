@extends('layouts.app')

@section('titulo', $book->title)

@section('contenido')
    <section class="my-5 md:my-10 container mx-auto px-3">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-4 md:p-6">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800">{{ $book->title }}</h1>

                <div class="flex flex-wrap gap-2">
                    @if ($book->pdf_file)
                        <a href="{{ route('user.books.download', $book) }}"
                            class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-2 sm:px-4 sm:py-2 rounded-md flex items-center text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1 sm:mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Descargar
                        </a>

                        <!-- Botón de Pantalla Completa -->
                        <button onclick="toggleFullscreen()"
                            class="bg-gray-700 hover:bg-gray-800 text-white px-3 py-2 sm:px-4 sm:py-2 rounded-md flex items-center text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1 sm:mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5">
                                </path>
                            </svg>
                            Pantalla Completa
                        </button>
                    @endif
                    <a href="{{ route('book.index') }}"
                        class="text-orange-500 hover:text-orange-600 border border-orange-500 px-3 py-2 sm:px-4 sm:py-2 rounded-md text-sm sm:text-base">
                        ← Volver
                    </a>
                </div>
            </div>

            <!-- Visualizador de PDF -->
            @if ($book->pdf_file)
                <div class="mb-6 md:mb-8 relative bg-gray-100 rounded-lg overflow-hidden">
                    <!-- Contenedor responsivo para el iframe -->
                    <div class="relative" style="padding-top: 75%;"> <!-- Relación de aspecto 4:3 -->
                        <iframe id="pdfViewer" src="{{ asset('storage/' . $book->pdf_file) }}#toolbar=0"
                            class="absolute top-0 left-0 w-full h-full border-0" frameborder="0" loading="lazy">
                        </iframe>
                    </div>

                    <!-- Botón flotante para pantalla completa -->
                    <button onclick="toggleFullscreen()" id="fullscreenBtn"
                        class="absolute top-3 right-3 bg-gray-700 hover:bg-gray-800 text-white p-2 rounded-md opacity-70 hover:opacity-100 transition-opacity">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5">
                            </path>
                        </svg>
                    </button>

                    <!-- Controles móviles adicionales -->
                    <div class="sm:hidden bg-white border-t border-gray-200 p-2 flex justify-between">
                        <button onclick="zoomOut()" class="text-gray-600 hover:text-gray-800 p-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                        </button>
                        <button onclick="zoomIn()" class="text-gray-600 hover:text-gray-800 p-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @else
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded">
                    <p class="text-sm md:text-base">Este libro no tiene un archivo PDF disponible.</p>
                </div>

                <!-- Contenido del libro como respaldo -->
                <div class="prose max-w-none">
                    <div class="text-center mb-6 md:mb-8">
                        <img src="{{ $book->image }}" alt="{{ $book->title }}"
                            class="w-32 h-44 sm:w-40 sm:h-56 md:w-48 md:h-64 object-cover mx-auto rounded-lg">
                        <p class="text-gray-600 mt-2 text-sm md:text-base">Por: {{ $book->author }}</p>
                    </div>

                    <div class="border-t pt-6">
                        <h2 class="text-lg sm:text-xl font-semibold mb-3 md:mb-4">Descripción</h2>
                        <p class="text-gray-700 leading-relaxed text-sm md:text-base">
                            {{ $book->description }}
                        </p>
                    </div>
                </div>
            @endif

            <!-- Información adicional -->
            <div class="mt-6 md:mt-8 border-t pt-6">
                <h3 class="text-base sm:text-lg font-semibold mb-3">Detalles del libro</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4 text-sm">
                    <div><span class="font-medium">Editorial:</span> {{ $book->editorial }}</div>
                    <div><span class="font-medium">Páginas:</span> {{ $book->pages }}</div>
                    <div><span class="font-medium">Formato:</span> {{ $book->format }}</div>
                    <div><span class="font-medium">ISBN:</span> {{ $book->isbn }}</div>
                </div>
            </div>
        </div>
    </section>

    @if ($book->pdf_file)
        <script>
            function toggleFullscreen() {
                const pdfViewer = document.getElementById('pdfViewer');
                const container = pdfViewer.parentElement.parentElement;

                if (!document.fullscreenElement) {
                    // Entrar en pantalla completa
                    if (container.requestFullscreen) {
                        container.requestFullscreen();
                    } else if (container.webkitRequestFullscreen) {
                        /* Safari */
                        container.webkitRequestFullscreen();
                    } else if (container.msRequestFullscreen) {
                        /* IE11 */
                        container.msRequestFullscreen();
                    }
                } else {
                    // Salir de pantalla completa
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.webkitExitFullscreen) {
                        /* Safari */
                        document.webkitExitFullscreen();
                    } else if (document.msExitFullscreen) {
                        /* IE11 */
                        document.msExitFullscreen();
                    }
                }
            }

            // Funciones de zoom para móviles
            function zoomIn() {
                const pdfViewer = document.getElementById('pdfViewer');
                let currentZoom = parseFloat(pdfViewer.style.zoom) || 1;
                pdfViewer.style.zoom = Math.min(currentZoom + 0.1, 2);
            }

            function zoomOut() {
                const pdfViewer = document.getElementById('pdfViewer');
                let currentZoom = parseFloat(pdfViewer.style.zoom) || 1;
                pdfViewer.style.zoom = Math.max(currentZoom - 0.1, 0.5);
            }

            // Actualizar botón de pantalla completa
            document.addEventListener('fullscreenchange', updateButton);
            document.addEventListener('webkitfullscreenchange', updateButton);
            document.addEventListener('msfullscreenchange', updateButton);

            function updateButton() {
                const fullscreenBtn = document.getElementById('fullscreenBtn');
                if (document.fullscreenElement) {
                    fullscreenBtn.innerHTML = `
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                `;
                } else {
                    fullscreenBtn.innerHTML = `
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5"></path>
                    </svg>
                `;
                }
            }

            // Tecla ESC para salir de pantalla completa
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && document.fullscreenElement) {
                    toggleFullscreen();
                }
            });

            // Optimización para móviles: prevenir zoom accidental con doble tap
            let lastTap = 0;
            document.addEventListener('touchend', function(e) {
                const currentTime = new Date().getTime();
                const tapLength = currentTime - lastTap;
                if (tapLength < 300 && tapLength > 0) {
                    e.preventDefault(); // Prevenir zoom del navegador
                }
                lastTap = currentTime;
            });
        </script>

        <style>
            /* Mejoras responsivas */
            @media (max-width: 640px) {
                #pdfViewer {
                    zoom: 0.8;
                    /* Zoom inicial para móviles */
                }
            }

            /* Estilos para pantalla completa */
            :-webkit-full-screen .bg-white {
                background: white;
            }

            :fullscreen .bg-white {
                background: white;
            }

            /* Mejorar visibilidad del botón en móviles */
            @media (max-width: 768px) {
                #fullscreenBtn {
                    top: 10px;
                    right: 10px;
                    background: rgba(55, 65, 81, 0.9);
                }
            }
        </style>
    @endif
@endsection
