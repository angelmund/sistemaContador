<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Incluir Font Awesome en tu archivo Blade principal -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha384-GLhlTQ8iN17Sme8k0I7jn0OomlGT73bz9qDf+5t5uGPAAeISSbsqE8/dJ6p7MVI" crossorigin="anonymous">
   
    {{--  @include('proyectos.edit')  --}}

    <!-- Scripts -->
    @vite(['resources/css/app.css' ,'resources/css/datatables.css','resources/js/app.js'])
    {{--  @vite(['css/app.css', 'css/datatables.css', 'js/app.js'])  stylesPagos--}}

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}

            {{--  @include('layouts.modales')  --}}
            @include('proyectos.edit')
        </main>
    </div>
</body>

</html>