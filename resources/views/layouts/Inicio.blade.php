<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Laravel')</title>


    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Datatables/data-tables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Datatables/dataTables.bootstrap5.css') }}">



</head>

<body>
    <div id="main" class="container-fluid">
        @include('layouts.NavBar')
        <div class="container p-4">
            <div class="card">
                <div class="card-body">
                    @yield('content')
                </div>
            </div>
            @include('layouts.Modal')
        </div>
    </div>

    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @yield('scripts')

</body>

</html>
