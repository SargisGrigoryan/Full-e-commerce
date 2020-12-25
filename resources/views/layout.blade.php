<?php

use App\Http\Controllers\UserController;

// Chekc if isset remember me cookies
if(Cookie::get('remember_user') && !session()->has('user')){
  $id =  Cookie::get('remember_user');
  if(session()->has('admin')){
      session()->pull('admin');
  }
  UserController::rememberUser($id);
}

?>
<!doctype html>
<html lang="en">
  <head>

    {{-- Head --}}
    @include('layouts/head')

  </head>
  <body>

    {{-- Header --}}
    @include('layouts/header')

    {{-- Include notifications --}}
    <x-notifications/>

    {{-- Content --}}
    @yield('content')

    {{-- Footer --}}


    {{-- Scripts --}}
    @include('layouts/scripts')

  </body>
</html>