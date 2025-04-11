<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
    <style>
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body>
@if(Auth::check() && Auth::user()->role === 'admin')
    <div class="flex h-screen">
        @include('components.navbar')

        <div class="flex-1 bg-white p-6 relative">
            <!-- Add silhouette effect for the logo -->
            <div class="absolute inset-3 bg-cover bg-center opacity-10" style="background-image: url('{{ asset('storage/images/logo.png') }}'); filter: blur(6px);"></div>
            
            <!-- Content goes here -->
            @yield('content')
        </div>
    </div>
@else
    <p class="text-center text-red-500">Unauthorized Access</p>
@endif

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</body>
</html>