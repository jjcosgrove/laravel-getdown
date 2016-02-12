<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GetDown</title>

    <link href="{{ asset('assets/vendor/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootswatch/'. (Auth::check() == true ? Auth::user()->preferences->theme : 'paper') .'/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/animate-css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/app/css/style.min.css') }}" rel="stylesheet">

    <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/EpicEditor/epiceditor/js/epiceditor.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/highlightjs/highlight.pack.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/hideseek/jquery.hideseek.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/FileSaver/FileSaver.min.js') }}"></script>
    <script src="{{ asset('assets/app/js/script.min.js') }}"></script>
</head>
<body>
    @include('partials.navbar')
    @yield('content')
</body>
</html>