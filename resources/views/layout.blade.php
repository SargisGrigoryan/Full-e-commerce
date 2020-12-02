<!doctype html>
<html lang="en">
  <head>

    {{-- Head --}}
    @include('layouts/head')

  </head>
  <body>

    {{-- Header --}}
    @include('layouts/header')

    {{-- Content --}}
    @yield('content')

    {{-- Footer --}}


    {{-- Scripts --}}
    @include('layouts/scripts')

  </body>
</html>