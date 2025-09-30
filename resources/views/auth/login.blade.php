@extends('layouts.app')

@section('titulo', 'Iniciar Sesión - Biblioteca Digital A&T')

@section('contenido')
    <x-auth.layouts.auth-container title="Iniciar Sesión" subtitle="Accede a tu cuenta de Biblioteca Digital">
        <x-auth.login-form />
    </x-auth.layouts.auth-container>
@endsection

@push('styles')
    @vite(['resources/css/components/auth/login.css', 'resources/css/components/auth/auth-form.css', 'resources/css/components/auth/auth-alert.css', 'resources/css/components/animations.css'])
@endpush

@push('scripts')
    @vite(['resources/js/components/auth/LoginForm.js', 'resources/js/components/auth/AuthAlert.js', 'resources/js/components/auth/LoginParticles.js'])
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar formulario de login
            new LoginForm();

            // Inicializar alertas
            new AuthAlert();

            // Inicializar partículas del fondo
            new LoginParticles();
        });
    </script>
@endpush
