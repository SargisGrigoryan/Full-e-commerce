<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gallery;

class UserController extends Controller
{
    // Get product details from db
    function getDetails($id){
        // Get current products datas from db
        $data = Product::find($id);

        // Get gallery from db
        $gallery = Gallery::all()->where('product_id', $id);

        // Get similar products
        $similar = Product::where('cat_id', $data->cat_id)->inRandomOrder()->limit(12)->get();

        return view('details', ['data' => $data, 'gallery_images' => $gallery, 'similar_products' => $similar]);
    }

    // Get home products from db
    function getHomeProducts(){
        // Get all slider products
        $slider_products = Product::where('slider', '1')->orderByDesc('id')->where('status', '1')->limit(12)->get();
        // Get all Top products
        $top_products = Product::where('top', '1')->orderByDesc('id')->where('status', '1')->limit(12)->get();
        // Get all Products
        $all_products = Product::where('status', '1')->orderByDesc('id')->paginate(12);

        return view('home', ['slider_products' => $slider_products, 'top_products' => $top_products, 'all_products' => $all_products]);
    }
}
