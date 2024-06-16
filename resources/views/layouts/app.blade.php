<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ioT Shop</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('assets/templateStyle/styles.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">

</head>
<body>

    {{-- include Navbar --}}
    @include('layouts.nav')

    {{-- content layouts --}}
    @yield('content')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ url('assets/templateStyle/scripts.js') }}"></script>

    {{-- Custom Script--}}
    @yield('script')

    <script>
        $(function(){
            setTimeout(() => {
                $('.alert-danger').hide();
            }, 1500);
        });
    </script>
</body>
</html>