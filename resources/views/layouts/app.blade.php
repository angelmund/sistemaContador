<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    

    <!----DataTables ----->
    <link rel="stylesheet" href="{{asset('DataTables/datatables.min.css')}}">
    <script src="{{asset('DataTables/datatables.min.js')}}"></script>

    <!----Bootstrap ----->
    <link rel="stylesheet" href="{{asset('bootstrap-5.2.3-dist/css/bootstrap.min.css')}}">
    <!-- Incluir Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>




    @vite(['resources/css/app.css'  ,'resources/js/app.js'])
    

    {{-- @include('proyectos.edit') --}}

    <!-- Scripts -->
    <link rel="stylesheet" href="{{asset('sweetalert2/sweetalert2.min.css')}}">
    @yield('css')
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

            {{-- @include('layouts.modales') --}}
            @include('proyectos.edit')
        </main>
    </div>
   
   
    @yield('js')
    <script src="{{asset('bootstrap-5.2.3-dist/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js">

    </script>

</body>

</html>
