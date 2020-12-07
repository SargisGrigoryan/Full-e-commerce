<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Gallery;
use Carbon\Carbon;

class AdminController extends Controller
{
    // Add category
    function addCat(Request $req){
        $cat = new Category;
        $cat->cat_name = $req->name;
        $result = $cat->save();

        if($result){
            return "Category is added successfully ";
        }else{
            return "Connection error please try again later";
        }
    }

    // Get Categories from db
    function getCat(){
        $data = Category::all();
        return view('addProduct', ['data' => $data]);
    }

    // Add product
    function addProduct(Request $req){

        $product = new Product;

        // General image
        $file_1 = $req->file('image');
        $file_name_1 = md5(Carbon::now()).'.'.$req->file('image')->getClientOriginalExtension();

        // Slider image
        if($req->file('slider_image')){
            $file_2 = $req->file('slider_image');
            $file_name_2 = md5(Carbon::now()).'.'.$req->file('slider_image')->getClientOriginalExtension();
            $product->slider_image  = '/'.'slider_images/'.$file_name_2;
        }

        $product->name          = $req->name;
        $product->descr         = $req->descr;
        $product->image         = '/'.'images/'.$file_name_1;
        $product->cat_id        = $req->cat_id;
        $product->colors        = $req->colors;
        $product->display       = $req->display;
        $product->camera        = $req->camera;
        $product->memory        = $req->memory;
        $product->ram           = $req->ram;
        $product->price         = $req->price;
        $product->discount      = $req->discount;
        $product->slider        = $req->slider;
        $product->top           = $req->top;
        $product->status        = $req->status;

        $result = $product->save();

        if($result){
            $file_1->move(base_path('\public\images'), $file_name_1);
            if($req->file('slider_image')){
                $file_2->move(base_path('\public\slider_images'), $file_name_2);
            }
            return "Product added successfully";
        }else{
            return "Connection error";
        }
    }
}
