<?php

namespace App\Http\Controllers;

// Use Default
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Hash;

// Use Models
use App\Models\Product;
use App\Models\Gallery;
use App\Models\User;
use App\Models\Cart;


use Illuminate\Http\Response;
use App\Http\Controller\Controllers;

class UserController extends Controller
{
    // Get product details from db
    function getDetails($id){
        // Get current products datas from db
        $data = Product::where('status', '1')->find($id);

        if($data){
            // Get gallery from db
            $gallery = Gallery::all()->where('product_id', $id);

            // Get similar products
            $similar = Product::where('cat_id', $data->cat_id)->inRandomOrder()->limit(12)->get();

            return view('details', ['data' => $data, 'gallery_images' => $gallery, 'similar_products' => $similar]);
        }else{
            session()->flash('notify_warning', 'Sorry, this product was removed or blocked, you can try again later.');
            return redirect('/');
        }
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

    // Register new user
    function register(Request $req){
        $user = new User;

        // Take all datas
        $first_name         = $req->input('first_name');
        $last_name          = $req->input('last_name');
        $personal_image     = $req->file('personal_image');
        $email              = $req->input('email');
        $password_1         = $req->input('password_1');
        $password_2         = $req->input('password_2');

        // Keep datas in flash session
        session()->flash('first_name', $first_name);
        session()->flash('last_name', $last_name);
        session()->flash('email', $email);
        session()->flash('password_1', $password_1);
        session()->flash('password_2', $password_2);

        // Check all required datas
        if(!$first_name){
            // Notify user
            session()->flash('notify_danger', 'Firstname is required.');
            return redirect('register');
        }
        if(!$last_name){
            // Notify user
            session()->flash('notify_danger', 'Lastname is required.');
            return redirect('register');
        }
        if(!$personal_image){
            // Notify user
            session()->flash('notify_danger', 'Personal image is required.');
            return redirect('register');
        }
        if(!$email){
            // Notify user
            session()->flash('notify_danger', 'Email is required.');
            return redirect('register');
        }
        if(!$password_1){
            // Notify user
            session()->flash('notify_danger', 'Password is required.');
            return redirect('register');
        }
        if(!$password_2){
            // Notify user
            session()->flash('notify_danger', 'Password confirmation is required.');
            return redirect('register');
        }

        // Check email if not already exists
        $check_email = $user::all()->where('email', $email);

        if(count($check_email) > 0){
            // Notify user
            session()->flash('notify_danger', 'Email is already registered, please try another one');
            return redirect('register');
        }else{
            // Generate image name
            $image_name = md5(Carbon::now().rand(1,10)).'.'.$personal_image->getClientOriginalExtension();

            // Check password confirmation
            if($password_1 != $password_2){
                // Notify user
                session()->flash('notify_danger', 'Confirm password is incorrect.');
                return redirect('register');
            }else{
                // Insert all datas in db
                $user->first_name       = $first_name;
                $user->last_name        = $last_name;
                $user->personal_image   = '/'.'user_images/'.$image_name;
                $user->email            = $email;
                $user->password         = Hash::make($password_1);

                $result = $user->save();

                if($result){
                    // Upload image
                    $personal_image->move(base_path('\public\user_images'), $image_name);
                    // notify user
                    session()->flash('notify_success', 'You have successfully registered');
                    return redirect('login');
                }else{
                    session()->flash('notify_danger', 'Connection error, please try again later');
                    return redirect('register');
                }
            }
        }

    }

    // User login
    function login(Request $req){
        $user = User::where('email', $req->email)->first();
        if(!$user || !Hash::check($req->password, $user->password)){
            // Notify user
            session()->flash('notify_danger', 'Email or password is incorrect');
            session()->flash('email', $req->input('email'));

            return redirect('login');
        }else{
            if(session()->has('admin')){
                session()->pull('admin');
            }
            session()->put('user', $user);
            return redirect('home');

        }
    }

    // User logout
    function logout(){
        if(session()->has('admin')){
            session()->pull('admin');
        }
        if(session()->has('user')){
            session()->pull('user');
        }
        return redirect('login');
    }

    // Get User datas from db
    function getUserProfile(){
        $user = User::find(Session::get('user')['id'])->first();
        return view('myProfile', ['userDatas' => $user]);
    }

    // User data changing 1
    function updateUserData(Request $req){
        // Get datas
        $first_name = $req->input('first_name');
        $last_name = $req->input('last_name');

        // CHeck datas
        if(strlen($first_name) > 1 && strlen($last_name) > 1){
            $user = User::find(Session::get('user')['id']);

            $user->first_name = $req->input('first_name');
            $user->last_name = $req->input('last_name');

            $result = $user->save();

            if($result){
                session()->flash('notify_success', 'Your datas was successfully saved');
                return redirect('myProfile');
            }else{
                session()->flash('notify_success', 'COnnection error please try again later');
                return redirect('myProfile');
            }
        }else{
            session()->flash('notify_warning', 'Warning, firstname or lastname must be minimum 2 chars.');
            return redirect('myProfile');
        }
    }

    // Update user password
    function updateUserPass(Request $req){
        // Get user from db
        $user = User::find(Session::get('user')['id'])->first();

        // Get datas
        $pass1 = $req->input('password_1');
        $pass2 = $req->input('password_2');
        $pass3 = $req->input('password_3');

        // Check new password
        if(strlen($pass1) < 3){
            session()->flash('notify_warning', 'Warning user password must be more than 2 chars.');
            return redirect('myProfile');
        }

        // Check current password
        if(!Hash::check($pass2, $user->password)){
            session()->flash('notify_danger', 'User password is incorrect.');
            return redirect('myProfile');
        }

        // Check confirm password
        if($pass2 != $pass3){
            session()->flash('notify_danger', 'Password confirmation is incorrect.');
            return redirect('myProfile');
        }

        $user->password = Hash::make($pass1);
        $result = $user->save();

        if($result){
            session()->flash('notify_success', 'Password was successfully saved.');
            return redirect('myProfile');
        }else{
            session()->flash('notify_danger', 'Connection error please try again later.');
            return redirect('myProfile');
        }
    }

    // Update user image
    function updateUserImage(Request $req){
        $user = User::find(Session::get('user')['id'])->first();

        // Get image
        $userImage = $req->file('personal_image');
        
        // Check image
        if(!$userImage){
            // Notify user
            session()->flash('notify_warning', 'Warning you have to choose user image before uploading.');
            return redirect('myProfile');
        }

        // Generate image name
        $image_name = md5(Carbon::now().rand(1,10)).'.'.$userImage->getClientOriginalExtension();

        // Update data in db
        $user->personal_image = '/'.'user_images/'.$image_name;
        $result = $user->save();

        if($result){
            // Upload image
            $userImage->move(base_path('\public\user_images'), $image_name);

            // Notify user
            session()->flash('notify_success', 'User image was successfully uploaded.');
            return redirect('myProfile');
        }else{
            session()->flash('notify_danger', 'Connection error please try again later.');
            return redirect('myProfile');
        }

        
    }

    // Add to cart
    function addToCart(Request $req){
        // Take required datas
        $user_id = session()->get('user')['id'];
        $product_id = $req->input('product_id');
        $qty = $req->input('qty');
        $color = $req->input('color');

        // Connect to the db
        $cart = new Cart;
        $cart->user_id = $user_id;
        $cart->product_id = $product_id;
        $cart->qty = $qty;
        $cart->color = $color;
        $result = $cart->save();

        if($result){
            session()->flash('notify_success', 'Product was added to cart successfully');
            return redirect('details/'.$product_id);
        }else{
            session()->flash('notify_danger', 'Connetion error please try again later');
            return redirect('details/'.$product_id);
        }
    }

    // Get user cart from db
    function getUserCart(){
        $user_id = session()->get('user')['id'];

        $cart = Cart::join('products', 'cart.product_id', '=', 'products.id')
        ->select('cart.color', 'cart.qty', 'cart.id', 'cart.product_id', 'products.image', 'products.name', 'products.descr', 'products.discount', 'products.price', 'products.status')
        ->where('cart.user_id', $user_id)
        ->where('cart.status', '1')
        ->get();

        return view('/cart', ['userCart' => $cart]);
    }

    // Remove from cart
    function removeFromCart($id){
        $cart = Cart::find($id);
        $result = $cart->delete();

        if($result){
            session()->flash('notify_success', 'Product was successfully removed from your cart.');
            return redirect('cart');
        }else{
            session()->flash('notify_danger', 'Connection error please try again later.');
            return redirect('cart');
        }
    }

    // Get number of user cart
    static function cartItem(){
        $user_id = Session::get('user')['id'];
        return Cart::where('user_id', $user_id)->count();
    }

    // But now
    function buyNow($id){
        $product = Product::where('status', '1')->find($id);
        if($product){
            return view('buyNow', ['product' => $product]);
        }else{
            session()->flash('notify_warning', 'Sorry, this product was removed or blocked, you can try again later.');
            return redirect('/');
        }
        
    }
}
