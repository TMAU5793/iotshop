<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Admin - Panel</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <link rel="icon" type="image/x-icon" href="{{ url('assets/images/favicon.png') }}">

   @include('admin.header')
</head>
<body>
   
   {{-- Section Content --}}
   @yield('content')

   {{-- Section footer --}}
   @include('admin.footer')

   {{-- Section Custom script --}}
   @yield('script')
   
</body>
</html>