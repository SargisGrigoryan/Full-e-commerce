<?php

namespace App\Http\Controllers;

// Use Default
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Lang;
use Stripe;

// Use Models
use App\Models\Product;
use App\Models\Gallery;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;


use Illuminate\Http\Response;
use App\Http\Controller\Controllers;

class UserController extends Controller
{
    // Get product details from db
    function getDetails($id){
        // Keep product id in sesion
        if(session()->has('details_id')){
            session()->pull('details_id');
        }
        session()->put('details_id', $id);

        // Get current products datas from db
        $data = Product::where('status', '1')->find($id);
        $reviews_count = Comment::where('product_id', $id)->count();

        if($data){
            // Get gallery from db
            $gallery = Gallery::all()->where('product_id', $id);

            // Get similar products
            $similar = Product::where('cat_id', $data->cat_id)->inRandomOrder()->limit(12)->get();

            return view('details', ['data' => $data, 'gallery_images' => $gallery, 'similar_products' => $similar, 'reviews_count' => $reviews_count]);
        }else{
            session()->flash('notify_warning', Lang::get('notify_user.warning_1'));
            return redirect('/');
        }
    }

    // Get home products from db
    function getHomeProducts(){
        // Get all slider products
        $slider_products = Product::where('slider', '1')->whereNotIn('in_stock', [0])->orderByDesc('id')->where('status', '1')->limit(12)->get();
        // Get all Top products
        $top_products = Product::where('top', '1')->whereNotIn('in_stock', [0])->orderByDesc('id')->where('status', '1')->limit(12)->get();
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
            session()->flash('notify_danger', Lang::get('notify_user.danger_1'));
            return redirect('register');
        }
        if(!$last_name){
            // Notify user
            session()->flash('notify_danger', Lang::get('notify_user.danger_2'));
            return redirect('register');
        }
        if(!$personal_image){
            // Notify user
            session()->flash('notify_danger', Lang::get('notify_user.danger_3'));
            return redirect('register');
        }
        if(!$email){
            // Notify user
            session()->flash('notify_danger', Lang::get('notify_user.danger_4'));
            return redirect('register');
        }
        if(!$password_1){
            // Notify user
            session()->flash('notify_danger', Lang::get('notify_user.danger_5'));
            return redirect('register');
        }
        if(!$password_2){
            // Notify user
            session()->flash('notify_danger', Lang::get('notify_user.danger_6'));
            return redirect('register');
        }

        // Check email if not already exists
        $check_email = $user::all()->where('email', $email);

        if(count($check_email) > 0){
            // Notify user
            session()->flash('notify_danger', Lang::get('notify_user.danger_7'));
            return redirect('register');
        }else{
            // Generate image name
            $image_name = md5(Carbon::now().rand(1,10)).'.'.$personal_image->getClientOriginalExtension();

            // Check password confirmation
            if($password_1 != $password_2){
                // Notify user
                session()->flash('notify_danger', Lang::get('notify_user.danger_8'));
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
                    session()->flash('notify_success', Lang::get('notify_user.success_1'));
                    return redirect('login');
                }else{
                    session()->flash('notify_danger', Lang::get('notify_user.danger_9'));
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
            session()->flash('notify_danger', Lang::get('notify_user.danger_10'));
            session()->flash('email', $req->input('email'));

            return redirect('login');
        }else{
            if($req->input('remember')){
                cookie()->queue('remember_user', $user->id, 30000);
            }
            if(session()->has('admin')){
                session()->pull('admin');
            }
            if(session()->has('user')){
                session()->pull('user');
            }
            session()->put('user', $user);
            return redirect('home');
        }
    }

    // Remeber user
    public static function rememberUser($id){
        $user = User::find($id);
        if(session()->has('admin')){
            session()->pull('admin');
        }
        if(session()->has('user')){
            session()->pull('user');
        }
        session()->put('user', $user);
        return redirect('home');
    }

    // User logout
    function logout(){
        if(session()->has('admin')){
            session()->pull('admin');
        }
        if(session()->has('user')){
            session()->pull('user');
        }
        cookie()->queue('remember_user', '', -30000);
        cookie()->queue('remember_admin', '', -30000);
        
        return redirect('login');
    }

    // Get User datas from db
    function getUserProfile(){
        $user = User::find(Session::get('user')['id']);
        return view('myProfile', ['userDatas' => $user]);
    }

    // Get user datas
    static function getUserDatas(){
        $user = User::find(Session::get('user')['id']);
        return $user;
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
                session()->flash('notify_success', Lang::get('notify_user.success_2'));
                return redirect('myProfile');
            }else{
                session()->flash('notify_danger', Lang::get('notify_user.connection_error'));
                return redirect('myProfile');
            }
        }else{
            session()->flash('notify_warning', Lang::get('notify_user.warning_2'));
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
            session()->flash('notify_warning', Lang::get('notify_user.warning_3'));
            return redirect('myProfile');
        }

        // Check current password
        if(!Hash::check($pass2, $user->password)){
            session()->flash('notify_danger', Lang::get('notify_user.danger_11'));
            return redirect('myProfile');
        }

        // Check confirm password
        if($pass2 != $pass3){
            session()->flash('notify_danger', Lang::get('notify_user.danger_12'));
            return redirect('myProfile');
        }

        $user->password = Hash::make($pass1);
        $result = $user->save();

        if($result){
            session()->flash('notify_success', Lang::get('notify_user.success_3'));
            return redirect('myProfile');
        }else{
            session()->flash('notify_danger', Lang::get('notify_user.connection_error'));
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
            session()->flash('notify_warning', Lang::get('notify_user.warning_4'));
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
            session()->flash('notify_success', Lang::get('notify_user.success_4'));
            return redirect('myProfile');
        }else{
            session()->flash('notify_danger', Lang::get('notify_user.connection_error'));
            return redirect('myProfile');
        }

        
    }

    // Add to cart
    function addToCart(Request $req){
        // Take required datas
        $user_id = session()->get('user')['id'];
        $product_id = $req->input('product_id');
        $qty = $req->input('qty');

        // Check quantity in stock
        $product = Product::find($product_id);
        if($qty > $product->in_stock || $qty < 1){
            session()->flash('notify_danger', Lang::get('notify_user.connection_error'));
            return redirect('home');
        };

        // Connect to the db
        $cart = new Cart;
        $cart->user_id = $user_id;
        $cart->product_id = $product_id;
        $cart->qty = $qty;
        $result = $cart->save();

        if($result){
            session()->flash('notify_success', Lang::get('notify_user.success_5'));
            return redirect('details/'.$product_id);
        }else{
            session()->flash('notify_danger', Lang::get('notify_user.connection_error'));
            return redirect('details/'.$product_id);
        }
    }

    // Get user cart from db
    function getUserCart(){
        $user_id = session()->get('user')['id'];

        $cart = Cart::join('products', 'cart.product_id', '=', 'products.id')
        ->select('cart.qty', 'cart.id', 'cart.product_id', 'products.image', 'products.name_en', 'products.name_ru', 'products.descr_en', 'products.descr_ru', 'products.discount', 'products.price', 'products.status', 'products.in_stock')
        ->where('cart.user_id', $user_id)
        ->where('cart.status', '1')
        ->paginate(10);

        return view('/cart', ['userCart' => $cart]);
    }

    // Remove from cart
    function removeFromCart($id){
        $cart = Cart::find($id);
        $result = $cart->delete();

        if($result){
            session()->flash('notify_success', Lang::get('notify_user.success_6'));
            return redirect('cart');
        }else{
            session()->flash('notify_danger', Lang::get('notify_user.connection_error'));
            return redirect('cart');
        }
    }

    // Get number of user cart
    static function cartItem(){
        $user_id = Session::get('user')['id'];
        return Cart::where('user_id', $user_id)->count();
    }

    // Buy now
    function buyNow(Request $req){
        $product = Product::where('status', '1')->find($req->product_id);
        if($product){
            // Check quantity in stock
            if($req->qty > $product->in_stock || $req->qty < 1){
                session()->flash('notify_danger', Lang::get('notify_user.connection_error'));
                return redirect('home');
            }else{
                return view('buyNow', ['product' => $product, 'product_qty' => $req->qty]);
            }
        }else{
            session()->flash('notify_warning', Lang::get('notify_user.warning_5'));
            return redirect('/');
        }
    }

    // Search
    function search(Request $req){
        $products = Product::where('name_en', 'like', '%'.$req->input('query').'%')
        ->orWhere('descr_en', 'like', '%'.$req->input('query').'%')
        ->orWhere('name_ru', 'like', '%'.$req->input('query').'%')
        ->orWhere('descr_ru', 'like', '%'.$req->input('query').'%')
        ->where('status', '1')
        ->paginate(12);

        return view('search', ['products' => $products, 'searched' => $req->input('query')]);
    }

    // Buy all user cart
    function buyAll(){
        $user_id = session()->get('user')['id'];

        $cart = Cart::join('products', 'cart.product_id', '=', 'products.id')
        ->select('cart.qty', 'cart.id', 'cart.product_id', 'products.discount', 'products.price')
        ->where('cart.user_id', $user_id)
        ->where('cart.status', '1')
        ->where('products.status', '1')
        ->whereNotIn('products.in_stock', [0])
        ->get();

        if(!count($cart) < 1){
            return view('buyAll', ['cart' => $cart]);
        }else{
            session()->flash('notify_warning', Lang::get('notify_user.warning_6'));
            return redirect('/cart');
        }
    }

    // Order all
    function orderAll(Request $req){
        // Get all required datas from user cart
        $user_id = session()->get('user')['id'];
        $cart = Cart::join('products', 'cart.product_id', '=', 'products.id')
        ->select('cart.qty', 'cart.id', 'cart.product_id', 'products.image', 'products.discount', 'products.price')
        ->where('cart.user_id', $user_id)
        ->where('cart.status', '1')
        ->where('products.status', '1')
        ->get();

        $product_qty = 0;
        $delivery_price = 15;
        $products_price = 0;
        $discounted_prices = 0;
        
        foreach ($cart as $item) {
            $product_qty += $item->qty;
            $products_price += ($item->price - ($item->discount * $item->price / 100)) * $item->qty;
        }

        // Connect to db
        $order = New Order;

        // Save datas
        $order->first_name = $req->first_name;
        $order->last_name = $req->last_name;
        $order->cvv = "1234-****-****-****";
        $order->products_qty = $product_qty;
        $order->products_price = $products_price;
        $order->delivery_price = $delivery_price;
        $order->user_id = $user_id;

        // Keep user datas in flash session 
        session()->flash('first_name', $req->first_name);
        session()->flash('last_name', $req->last_name);

        // check all required datas
        if(!$req->first_name){
            session()->flash('notify_warning', Lang::get('notify_user.warning_7'));
            return redirect('/buyAll');
        }
        
        if(!$req->last_name){
            session()->flash('notify_warning', Lang::get('notify_user.warning_8'));
            return redirect('/buyAll');
        }

        $result = $order->save();

        if($result){
            // After all remove user cart's ordered products
            foreach ($cart as $item) {
                Cart::find($item->id)->delete();
            }
            session()->flash('notify_success', Lang::get('notify_user.success_7'));
            return redirect('/orders');
        }else{
            session()->flash('notify_danger', Lang::get('notify_user.connection_error'));
            return redirect('/cart');
        }
    }

    // Order now
    function orderNow(Request $req){
        $user_id = session()->get('user')['id'];

        $product = Product::where('status', '1')->find($req->id);
        if($product){
            $products_qty = $req->qty;
            $delivery_price = 10;

            // Connect to db
            $order = New Order;
            
            // Save datas
            $order->first_name = $req->first_name;
            $order->last_name = $req->last_name;
            $order->cvv = "1234-****-****-****";
            $order->products_qty = $products_qty;
            $order->products_price = ($product->price - ($product->discount * $product->price / 100)) * $products_qty;
            $order->delivery_price = $delivery_price;
            $order->user_id = $user_id;

            $result = $order->save();

            if($result){
                session()->flash('notify_success', Lang::get('notify_user.success_7'));
                return redirect('/orders');
            }else{
                session()->flash('notify_danger', Lang::get('notify_user.connection_error'));
                return redirect('/cart');
            }
        }else{
            session()->flash('notify_danger', Lang::get('notify_user.danger_13'));
            return redirect('/cart');
        }
    }

    // Get user orders
    function getOrders(){
        $user_id = session()->get('user')['id'];
        $orders = Order::where('user_id', $user_id)->orderByDesc('id')->paginate(12);
        return view('orders', ['orders' => $orders]);
    }

    // Leave comment
    public function leaveComment(Request $req){
        $user_id = 0;
        $admin_id = 0;

        if(session()->has('user')){
            $user_id = session()->get('user')['id'];
        }
        if(session()->has('admin')){
            $admin_id = session()->get('admin')['id'];
        }
    
        $comment = new Comment;

        if($req->comment){
            if($user_id != 0){
                $comment->user_id = $user_id;
            }else if($admin_id != 0){
                $comment->admin_id = $admin_id;
            }
            $comment->comment = $req->comment;
            $comment->product_id = $req->productId;
            $comment->save();
        }
    }

    // get Comments
    public function getComments(){
        if(session()->has('details_id')){
            $id = session()->get('details_id');

            $admin_id = '0';
            $user_id = '0';
            
            if(session()->has('user')){
                $user_id = session()->get('user')['id'];
            }else if(session()->has('admin')){
                $admin_id = session()->get('admin')['id'];
            }

            // Get all comments
            $comments = Comment::where('comments.product_id', $id)->orderByDesc('comments.id')->get();
            $users = User::join('comments', 'comments.user_id', '=', 'users.id')->get();
            // $comments = Comment::join('users', 'comments.user_id', '=', 'users.id')
            // ->select('users.first_name', 'users.personal_image', 'comments.comment', 'comments.date', 'comments.status', 'users.id', 'comments.user_id', 'comments.admin_id')
            // ->where('comments.product_id', $id)
            // ->orderByDesc('comments.id')->get();      


            return response()->json(['comments' => $comments, 'current_user' => $user_id, 'current_admin' => $admin_id, 'users' => $users]);
        }else{
            return redirect('/');
        }
    }

    // Change locale
    public function changeLocale($locale){
        session()->put('locale', $locale);
        App::setLocale($locale);
        return redirect()->back();
    }

    // Payment with stripe
    public function stripePost(Request $req){
        // Get all required datas from user cart
        $user_id = session()->get('user')['id'];
        $cart = Cart::join('products', 'cart.product_id', '=', 'products.id')
        ->select('cart.qty', 'cart.id', 'cart.product_id', 'products.image', 'products.discount', 'products.price')
        ->where('cart.user_id', $user_id)
        ->where('cart.status', '1')
        ->where('products.status', '1')
        ->get();

        $product_qty = 0;
        $delivery_price = 15;
        $products_price = 0;
        $discounted_prices = 0;
        
        // Count total price of all ordering cart
        foreach ($cart as $item) {
            $product_qty += $item->qty;
            $products_price += ($item->price - ($item->discount * $item->price / 100)) * $item->qty;
        }
        $total_price = $products_price + $delivery_price;

        // Pay now
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * $total_price,
                "currency" => "usd",
                "source" => $req->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);

        // Register order
        $order = New Order;

        // Save datas
        $order->card_holder = $req->card_holder;
        $order->products_qty = $product_qty;
        $order->products_price = $products_price;
        $order->delivery_price = $delivery_price;
        $order->user_id = $user_id;
  
        $result = $order->save();

        if($result){
            // After all remove user cart's ordered products
            foreach ($cart as $item) {
                Cart::find($item->id)->delete();
            }
            session()->flash('notify_success', Lang::get('notify_user.success_7'));
            return redirect('/orders');
        }else{
            session()->flash('notify_danger', Lang::get('notify_user.connection_error'));
            return redirect('/cart');
        }
    }
}
