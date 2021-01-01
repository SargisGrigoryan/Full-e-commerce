<?php

namespace App\Http\Controllers;

// Use default
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use File;

// Use models
use App\Models\Category;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Admin;



class AdminController extends Controller
{
    // Get categories for showing cat lists
    function getAllCats(){
        $cat = Category::paginate(12);
        $products_cats = Product::select('products.cat_id')->get();
        return view('cat', ['cats' => $cat, 'products_cats' => $products_cats]);
    }

    // Add category
    function addCat(Request $req){
        $cat = new Category;
        $cat->cat_name = $req->name;
        $result = $cat->save();

        if($result){
            session()->flash('notify_success', 'Category is added successfully');
            return redirect('cat');
        }else{
            session()->flash('notify_danger', 'Connection error please try again later');
            return redirect('cat');
        }
    }

    // Get Categories for adding new product
    function getCat(){
        $data = Category::all();
        return view('addProduct', ['data' => $data]);
    }

    // Edit cat
    function getEditingCat($id){
        $cat = Category::find($id);
        return view('editCat', ['cat' => $cat]);
    }

    // Save cat
    function saveCat(Request $req){
        $cat_name = $req->input('name');
        $cat_id = $req->input('id');
        $cat = Category::find($cat_id);
        $cat->cat_name = $cat_name;
        $result = $cat->save();
        if($result){
            session()->flash('notify_success', 'Category was successfully edited.');
            return redirect('cat');
        }else{
            session()->flash('notify_danger', 'Connection error, please try again later.');
            return redirect()->back();
        }
    }

    // Remove cat
    function removeCat($id){
        $removeCat = Category::find($id);
        $result = $removeCat->delete();

        if($result){
            session()->flash('notify_success', 'Category was successfully removed.');
            return redirect()->back();
        }else{
            session()->flash('notify_danger', 'Connection error, please try again later.');
            return redirect()->back();
        }
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
        $product->in_stock      = $req->in_stock;
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

            session()->flash('notify_success', 'Product added successfully');
            return redirect('addProduct');
        }else{
            session()->flash('notify_danger', 'Connection error please try again later');
            return redirect('addProduct');
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
            if($req->input('remember')){
                cookie()->queue('remember_admin', $admin->id, 30000);
            }
            if(session()->has('admin')){
                session()->pull('admin');
            }
            if(session()->has('user')){
                session()->pull('user');
            }
            session()->put('admin', $admin);
            return redirect('home');
        }
    }

    // Remember admin
    public static function rememberAdmin($id){
        $admin = Admin::find($id);
        if(session()->has('admin')){
            session()->pull('admin');
        }
        if(session()->has('user')){
            session()->pull('user');
        }
        session()->put('admin', $admin);
        return redirect('home');
    }

    // Admin Logout
    function adminLogout(){
        if(session()->has('admin')){
            session()->pull('admin');
        }
        if(session()->has('user')){
            session()->pull('user');
        }
        cookie()->queue('remember_user', '', -30000);
        cookie()->queue('remember_admin', '', -30000);

        return redirect('/');
    }

    // Get product datas for editing
    function getProduct($id){
        $product = Product::find($id);
        if($product->status != 2){
            $cats = Category::all();
            $gallery = Gallery::where('product_id', $id)->get();
            return view('editProduct', ['product' => $product, 'cats' => $cats, 'gallery' => $gallery]);
        }else{
            session()->flash('notify_warning', 'You can not edit removed products, you can recover it in blocked mode than edit and save as public.');
            return redirect('/');
        }
    }

    // Save product details
    function saveProduct(Request $req){
        // Take original gallery data
        $name = $req->name;
        $descr = $req->descr;
        $image = $req->image;
        $cat_id = $req->cat_id;
        $colors = $req->colors;
        $display = $req->display;
        $camera = $req->camera;
        $memory = $req->memory;
        $ram = $req->ram;
        $price = $req->price;
        $discount = $req->discount;
        $in_stock = $req->in_stock;
        $slider = $req->slider;
        $slider_image = $req->slider_image;
        $top = $req->top;
        $status = $req->status;

        $product = Product::find($req->id);
        $product->name = $name;
        $product->descr = $descr;
        // General image
        if($image){
            $file_1 = $req->file('image');
            $file_name_1 = md5(Carbon::now().rand(1,10)).'.'.$req->file('image')->getClientOriginalExtension();
            $product_image_old = $product->image;
            if(File::exists(public_path($product_image_old))){
                File::delete(public_path($product_image_old));
            }
            $product->image = '/'.'images/'.$file_name_1;
        }
        $product->cat_id = $cat_id;
        $product->colors = $colors;
        $product->display = $display;
        $product->camera = $camera;
        $product->memory = $memory;
        $product->ram = $ram;
        $product->price = $price;
        $product->discount = $discount;
        $product->in_stock = $in_stock;
        // Slider image
        if($slider == 1 && $slider_image){
            $file_2 = $req->file('slider_image');
            $file_name_2 = md5(Carbon::now().rand(1,10)).'.'.$req->file('slider_image')->getClientOriginalExtension();
            $slider_image_old = $product->slider_image;
            if(File::exists(public_path($slider_image_old))){
                File::delete(public_path($slider_image_old));
            }
            $product->slider_image = '/'.'slider_images/'.$file_name_2;
        }
        $product->slider = $slider;
        $product->top = $top;
        $product->status = $req->status;

        $result = $product->save();

        if($result){
            // General image
            if($image){
                $file_1->move(base_path('\public\images'), $file_name_1);
            }
            // Slider image
            if($slider_image){
                $file_2->move(base_path('\public\slider_images'), $file_name_2);
            }

            // Take gallery images from db
            $gallery_1 = Gallery::where('product_id', $req->id)->first();
            $gallery_2 = Gallery::where('product_id', $req->id)->skip(1)->first();
            $gallery_3 = Gallery::where('product_id', $req->id)->skip(2)->first();

            // Get gallery images from admin
            $gallery_image_1 = $req->gallery_image_1;
            $gallery_image_2 = $req->gallery_image_2;
            $gallery_image_3 = $req->gallery_image_3;

            // Gallery 1 changing or adding
            if($gallery_image_1){
                $gallery_name_1 = md5(Carbon::now().rand(1,10)).'.'.$gallery_image_1->getClientOriginalExtension();
                if($gallery_1){
                    $gallery_1_old = $gallery_1->src;

                    if(File::exists(public_path($gallery_1_old))){
                        File::delete(public_path($gallery_1_old));
                    }
                    $gallery_1->src = '/'.'gallery/'.$gallery_name_1;
                    $gallery_1->save();
                    $gallery_image_1->move(base_path('\public\gallery'), $gallery_name_1);
                }else{
                    $gallery_1 = new Gallery;
                    $gallery_1->src = '/'.'gallery/'.$gallery_name_1;
                    $gallery_1->product_id = $req->id;
                    $gallery_1->save();
                    $gallery_image_1->move(base_path('\public\gallery'), $gallery_name_1);
                }
            }

            // Gallery 2 changing or adding
            if($gallery_image_2){
                $gallery_name_2 = md5(Carbon::now().rand(1,10)).'.'.$gallery_image_2->getClientOriginalExtension();
                if($gallery_2){
                    $gallery_2_old = $gallery_2->src;

                    if(File::exists(public_path($gallery_2_old))){
                        File::delete(public_path($gallery_2_old));
                    }
                    $gallery_2->src = '/'.'gallery/'.$gallery_name_2;
                    $gallery_2->save();
                    $gallery_image_2->move(base_path('\public\gallery'), $gallery_name_2);
                }else{
                    $gallery_2 = new Gallery;
                    $gallery_2->src = '/'.'gallery/'.$gallery_name_2;
                    $gallery_2->product_id = $req->id;
                    $gallery_2->save();
                    $gallery_image_2->move(base_path('\public\gallery'), $gallery_name_2);
                }
            }

            // Gallery 3 changing or adding
            if($gallery_image_3){
                $gallery_name_3 = md5(Carbon::now().rand(1,10)).'.'.$gallery_image_3->getClientOriginalExtension();
                if($gallery_3){
                    $gallery_3_old = $gallery_3->src;

                    if(File::exists(public_path($gallery_3_old))){
                        File::delete(public_path($gallery_3_old));
                    }
                    $gallery_3->src = '/'.'gallery/'.$gallery_name_3;
                    $gallery_3->save();
                    $gallery_image_3->move(base_path('\public\gallery'), $gallery_name_3);
                }else{
                    $gallery_3 = new Gallery;
                    $gallery_3->src = '/'.'gallery/'.$gallery_name_3;
                    $gallery_3->product_id = $req->id;
                    $gallery_3->save();
                    $gallery_image_3->move(base_path('\public\gallery'), $gallery_name_3);
                }
            }

            // Notify user
            session()->flash('notify_success', 'Product was successfully updated');
            return redirect('editProduct/'.$req->id);
        }else{
            session()->flash('notify_danger', 'COnnection error please try again later');
            return redirect('editProduct/'.$req->id);
        }

        return $image;
    }

    // Get active products
    function getActiveProducts(){
        // Get all active products
        $products_active = Product::join('categories', 'products.cat_id', '=', 'categories.id')
        ->select('products.id', 'products.name', 'products.descr', 'products.image', 'products.colors', 
        'products.display', 'products.camera', 'products.memory', 'products.ram', 
        'products.slider', 'products.price', 'products.discount', 'products.top', 
        'products.status', 'products.date', 'categories.cat_name', 'products.in_stock')->where('products.status', '1')->orderByDesc('id')->paginate(6);

        // Get active products qty
        $products_active_qty = Product::where('status', '1')->count();

        // Send all datas to user side
        return view('activeProducts', [
            'products_active' => $products_active, 
            'products_active_qty' => $products_active_qty
        ]);
    }

    // Get blocked products
    function getBlockedProducts(){
        // Get all blocked products
        $products_blocked = Product::join('categories', 'products.cat_id', '=', 'categories.id')
        ->select('products.id', 'products.name', 'products.descr', 'products.image', 'products.colors', 
        'products.display', 'products.camera', 'products.memory', 'products.ram', 
        'products.slider', 'products.price', 'products.discount', 'products.top', 
        'products.status', 'products.date', 'categories.cat_name', 'products.in_stock')->where('products.status', '0')->paginate(6);

        // Get blocked products qty
        $products_blocked_qty = Product::where('status', '0')->count();

        // Send all datas to user side
        return view('blockedProducts', [
            'products_blocked' => $products_blocked, 
            'products_blocked_qty' => $products_blocked_qty
        ]);
    }

    // Get removed products
    function getRemovedProducts(){
        // Get all removed products
        $products_removed = Product::join('categories', 'products.cat_id', '=', 'categories.id')
        ->select('products.id', 'products.name', 'products.descr', 'products.image', 'products.colors', 
        'products.display', 'products.camera', 'products.memory', 'products.ram', 
        'products.slider', 'products.price', 'products.discount', 'products.top', 
        'products.status', 'products.date', 'categories.cat_name', 'products.in_stock')->where('products.status', '2')->paginate(6);

        // Get removed products qty
        $products_removed_qty = Product::where('status', '2')->count();

        // Send all datas to user side
        return view('removedProducts', [
            'products_removed' => $products_removed,
            'products_removed_qty' => $products_removed_qty
        ]);
    }

    // Get active products
    static function getActiveProductsqty(){
        // Get active products qty
        return Product::where('status', '1')->count();
    }

    // Get blocked products
    static function getBlockedProductsqty(){
        // Get blocked products qty
        return Product::where('status', '0')->count();
    }

    // Get removed products
    static function getRemovedProductsqty(){
        // Get removed products qty
        return Product::where('status', '2')->count();
    }

    // Remove product from active
    function blockProductFromActive($id){
        $product = Product::find($id);
        $product->status = '0';
        $result = $product->save();
        if($result){
            session()->flash('notify_success', 'Product was successfully blocked');
            return redirect('activeProducts');
        }else{
            session()->flash('notify_danger', 'Connection error please try again later');
            return redirect('activeProducts');
        }
    }

    // Recover product from active
    function removeProductFromActive($id){
        $product = Product::find($id);
        $product->status = '2';
        $result = $product->save();
        if($result){
            session()->flash('notify_success', 'Product was successfully removed');
            return redirect('activeProducts');
        }else{
            session()->flash('notify_danger', 'Connection error please try again later');
            return redirect('activeProducts');
        }
    }

    // Remove product from blocked
    function removeProductFromBlocked($id){
        $product = Product::find($id);
        $product->status = '2';
        $result = $product->save();
        if($result){
            session()->flash('notify_success', 'Product was successfully removed');
            return redirect('blockedProducts');
        }else{
            session()->flash('notify_danger', 'Connection error please try again later');
            return redirect('blockedProducts');
        }
    }

    // Recover product from blocked
    function recoverProductFromBlocked($id){
        $product = Product::find($id);
        $product->status = '1';
        $result = $product->save();
        if($result){
            session()->flash('notify_success', 'Product was successfully recovered');
            return redirect('blockedProducts');
        }else{
            session()->flash('notify_danger', 'Connection error please try again later');
            return redirect('blockedProducts');
        }
    }

    // Recover product from trash
    function recoverProductFromTrash($id){
        $product = Product::find($id);
        $product->status = '1';
        $result = $product->save();
        if($result){
            session()->flash('notify_success', 'Product was successfully recovered');
            return redirect('removedProducts');
        }else{
            session()->flash('notify_danger', 'Connection error please try again later');
            return redirect('removedProducts');
        }
    }

    // Block product from trash
    function blockProductFromTrash($id){
        $product = Product::find($id);
        $product->status = '0';
        $result = $product->save();
        if($result){
            session()->flash('notify_success', 'Product was successfully blocked');
            return redirect('removedProducts');
        }else{
            session()->flash('notify_danger', 'Connection error please try again later');
            return redirect('removedProducts');
        }
    }
}
