<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

$cart_counter = 0;
if(Session::has('user')){
  $cart_counter = UserController::cartItem();
}

if(Session::has('admin')){
  $active_product_counter = AdminController::getActiveProductsQty();
  $blocked_product_counter = AdminController::getBlockedProductsQty();
  $removed_product_counter = AdminController::getRemovedProductsQty();
  $all_product_counter = $active_product_counter + $blocked_product_counter + $removed_product_counter;
}

?>

<!-- Header Navigation -->
<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/">E-Comm</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="/">Home</a>
                </li>
                @if (session()->has('admin'))
                  <li class="nav-item">
                    <a class="nav-link" href="/addProduct">Add product</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/addCat">Add category</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Products ({{ $all_product_counter }})
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="/activeProducts">Active Products ({{ $active_product_counter }})</a></li>
                      <li><a class="dropdown-item" href="/blockedProducts">Blocked Products ({{ $blocked_product_counter }})</a></li>
                      <li><a class="dropdown-item" href="/removedProducts">Removed Products ({{ $removed_product_counter }})</a></li>
                    </ul>
                  </li>
                @endif
                @if (session()->has('user'))
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      {{ session()->get('user')['first_name'] }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="/myProfile">My profile</a></li>
                      <li><a class="dropdown-item" href="/cart">Cart ({{ $cart_counter }})</a></li>
                      <li><a class="dropdown-item" href="/orders">Order list</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                  </li>
                @else
                @if (!session()->has('admin'))
                  <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                  </li>
                @else
                  <li class="nav-item">
                    <a class="nav-link" href="/adminLogout">logout</a>
                  </li>
                @endif
                @endif
              </ul>
              <form class="form-inline my-2 my-lg-0" action="/search" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="query">
                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
              </form>
            </div>
        </div>
    </nav>
</header>
<!-- Header Navigation end -->