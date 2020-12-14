<?php

namespace App\Http\Controllers;

// Use default
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

// Use models
use App\Models\Category;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Admin;



class AdminController extends Controller
{
    // Add category
    function addCat(Request $req){
        $cat = new Category;
        $cat->cat_name = $req->name;
        $result = $cat->save();

        if($result){
            session()->flash('notify_success', 'Category is added successfully');
            return redirect('addCat');
        }else{
            session()->flash('notify_danger', 'Connection error please try again later');
            return redirect('addCat');
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
        $file_name_1 = md5(Carbon::now().rand(1,10)).'.'.$req->file('image')->getClientOriginalExtension();

        // Slider image
        if($req->file('slider_image')){
            $file_2 = $req->file('slider_image');
            $file_name_2 = md5(Carbon::now().rand(21,30)).'.'.$req->file('slider_image')->getClientOriginalExtension();
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
            // General image
            $file_1->move(base_path('\public\images'), $file_name_1);

            // Slider image
            if($req->file('slider_image')){
                $file_2->move(base_path('\public\slider_images'), $file_name_2);
            }

            // Gallery images
            if($req->file('gallery_image_1')){
                $gallery = new Gallery;
                $gallery_image_1 = $req->file('gallery_image_1');
                $gallery_image_name_1 = md5(Carbon::now().'-'.rand(11, 20)).'.'.$req->file('gallery_image_1')->getClientOriginalExtension();
                $gallery_image_1->move(base_path('\public\gallery'), $gallery_image_name_1);
                $gallery->src = '/'.'gallery/'.$gallery_image_name_1;
                $gallery->product_id = $product->id;
                $gallery->save();
            }
            if($req->file('gallery_image_2')){
                $gallery = new Gallery;
                $gallery_image_2 = $req->file('gallery_image_2');
                $gallery_image_name_2 = md5(Carbon::now().'-'.rand(11, 20)).'.'.$req->file('gallery_image_2')->getClientOriginalExtension();
                $gallery_image_2->move(base_path('\public\gallery'), $gallery_image_name_2);
                $gallery->src = '/'.'gallery/'.$gallery_image_name_2;
                $gallery->product_id = $product->id;
                $gallery->save();
            }
            if($req->file('gallery_image_3')){
                $gallery = new Gallery;
                $gallery_image_3 = $req->file('gallery_image_3');
                $gallery_image_name_3 = md5(Carbon::now().'-'.rand(11, 20)).'.'.$req->file('gallery_image_3')->getClientOriginalExtension();
                $gallery_image_3->move(base_path('\public\gallery'), $gallery_image_name_3);
                $gallery->src = '/'.'gallery/'.$gallery_image_name_3;
                $gallery->product_id = $product->id;
                $gallery->save();
            }

            return "Product added successfully";
        }else{
            return "Connection error";
        }
    }

    // Admin login
    function adminLogin(Request $req){
        $email = $req->input('email');
        $pass = $req->input('password');

        $admin = Admin::where('email', $email)->first();

        if(!$admin || !Hash::check($pass, $admin->password)){
            session()->flash('notify_danger', 'Email or password is incorrect');
            session()->flash('email', $email);
            return redirect('admin');
        }else{
            session()->put('admin', $admin);

            if(session()->has('user')){
                session()->pull('user');
            }

            return redirect('home');
        }
    }

    // Admin Logout
    function adminLogout(){
        if(session()->has('admin')){
            session()->pull('admin');
        }
        if(session()->has('user')){
            session()->pull('user');
        }
        return redirect('/');
    }
}
