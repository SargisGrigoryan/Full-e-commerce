<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class UserController extends Controller
{
    // Get product details from db
    function getDetails($id){
        $data = Product::find($id);
        return view('details', ['data' => $data]);
    }

    // Get home products from db
    function getHomeProducts(){
        // Get all slider products
        $slider_products = Product::all()->where('slider', '1')->where('status', '1');
        // Get all Top products
        $top_products = Product::all()->where('top', '1')->where('status', '1');
        // Get all Products
        $all_products = Product::all()->where('status', '1');

        return view('home', ['slider_products' => $slider_products, 'top_products' => $top_products, 'all_products' => $all_products]);
    }
}
