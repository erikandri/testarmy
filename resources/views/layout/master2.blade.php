<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Erik Web</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
          content="Erik Andri Budiman, Cyberarmy">
    <meta name="description" content="Program Input Nilai - Cyberarmy">
    <meta name="author" content="Erik Andri Budiman">

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

    <!-- plugin css -->
    <!-- end plugin css -->

    @stack('plugin-styles')

    <!-- common css -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet"/>
    <!-- end common css -->

    @stack('style')
</head>
<body data-base-url="{{url('/')}}">

{{--<script src="{{ asset('assets/js/spinner.js') }}"></script>--}}

<div class="main-wrapper" id="app">
    <div class="page-wrapper full-page">
        @yield('content')
    </div>
</div>

<!-- base js -->
<script src="{{ mix('js/app.js') }}"></script>
<!-- end base js -->

<!-- plugin js -->
@stack('plugin-scripts')
<!-- end plugin js -->

<!-- common js -->
<!-- end common js -->

@stack('custom-scripts')
</body>
</html>
