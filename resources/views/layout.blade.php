<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// Chekc if isset remember me cookies
if(Cookie::get('remember_user') && !session()->has('user')){
  $id =  Cookie::get('remember_user');
  UserController::rememberUser($id);
}
if(Cookie::get('remember_admin') && !session()->has('admin')){
  $id =  Cookie::get('remember_admin');
  AdminController::rememberAdmin($id);
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