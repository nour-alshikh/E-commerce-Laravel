<?php

namespace App\Http\Controllers;

use Stripe;
use Session;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Reply;
use App\Models\Testim;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index(){
        $products=Product::paginate(10);
        $comments = Comment::orderby('id', 'desc')->get();
        $reply = Reply::orderby('id', 'desc')->get();
        $testims = Testim::all();
        $cart = 0;
        return view('home.userpage', compact('products' , 'comments' , 'reply' , 'testims' , 'cart'));
    }

    public function redirect(){
        $usertype = Auth::user()->usertype;

        if($usertype == 1)
        {
            $total_products = Product::all()->count();
            $total_orders = Order::all()->count();
            $total_cust = User::all()->count();
            $orders = Order::all();
            $total_revenue = 0;
            foreach($orders as $order){
                $total_revenue = $total_revenue + $order->price;
            };
            $orders_delivered = Order::where('delivery_status' , '=' , 'Delivered')->get()->count();
            $orders_processing = Order::where('delivery_status' , '=' , 'Proccessing')->get()->count();
            return view('admin.home' , compact('total_products' , 'total_orders' , 'total_cust' , 'total_revenue' , 'orders_delivered' ,'orders_processing'));
        }
        else{
        $products=Product::paginate(10);
        $comments = Comment::orderby('id', 'desc')->get();
        $reply = Reply::orderby('id', 'desc')->get();
        $testims = Testim::all();
        $cart = Cart::all()->count();
        return view('home.userpage', compact('products' , 'comments' , 'reply' , 'testims' , 'cart'));
        }
    }

    public function product_details($id){
        $product = Product::findOrFail($id);
        $cart = Cart::all()->count();
        return view('home.product_details' , compact('product' , 'cart'));
    }

    public function add_cart(Request $request,$id){
        if(Auth::id()){
            $user = Auth::user();
            $product = Product::findOrFail($id);

            $product_exist_id = Cart::where('product_id' , '=' , $id)->where('user_id' , '=' , $user->id)->get('id')->first();

            if($product_exist_id){
                $cart = Cart::findOrFail($product_exist_id)->first();

                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;

                if($product->discount_price != null){
                    $cart->price = $product->discount_price * $cart->quantity;
                 }else{
                    $cart->price = $product->price * $cart->quantity;
                }

                $cart->save();
                Alert::success('Product Added successfully' , 'We have added Product to the cart');
                return redirect()->back();

            }else{
                $cart = new Cart;

                $cart->name = $user->name;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->email = $user->email;
                $cart->user_id = $user->id;

                $cart->product_title = $product->title;
                $cart->product_id = $product->id;

                if($product->discount_price != null){
                    $cart->price = $product->discount_price * $request->quantity;
                 }else{
                    $cart->price = $product->price * $request->quantity;
                }

                $cart->image = $product->image;
                $cart->quantity = $request->quantity;

                $cart->save();

                return redirect()->back();
            }
        }else{

            return redirect('login');
        }
    }

    public function show_cart(){
        if(Auth::id()){
            $id = Auth::user()->id;
            $carts = Cart::where('user_id', '=' , $id)->get();
            $cart = Cart::all()->count();
            return view('home.show_cart', compact('carts', 'cart'));
        }else{
            return redirect('login');
        }
    }

    public function del_cart($id){
        $item = Cart::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('del_message' , 'Product Deleted successfully');
    }

    public function order_cash(){
        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id' , '=' ,$user_id)->get();

        foreach($cart as $item)
        {
            $order = new Order;
            $order->name = $item->name;
            $order->email = $item->email;
            $order->phone = $item->phone;
            $order->address = $item->address;
            $order->user_id = $item->user_id;
            $order->product_title = $item->product_title;
            $order->image = $item->image;
            $order->price = $item->price;
            $order->quantity = $item->quantity;
            $order->product_id = $item->product_id;
            $order->payment_status = "Cash on delivery";
            $order->delivery_status = "Proccessing";
            $order->save();

            $item = Cart::findOrFail($item->id);
            $item->delete();
        }
        return redirect()->back()->with('order_message' , 'Order Made Successfully. You will hear from us soon...');
    }

    public function stripe($total_price){
        return view('home.stripe' , compact('total_price'));
    }

     public function stripePost(Request $request , $total_price)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => $total_price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Paid successfully"
        ]);

        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id' , '=' ,$user_id)->get();

        foreach($cart as $item)
        {
            $order = new Order;
            $order->name = $item->name;
            $order->email = $item->email;
            $order->phone = $item->phone;
            $order->address = $item->address;
            $order->user_id = $item->user_id;
            $order->product_title = $item->product_title;
            $order->image = $item->image;
            $order->price = $item->price;
            $order->quantity = $item->quantity;
            $order->product_id = $item->product_id;
            $order->payment_status = "Paid";
            $order->delivery_status = "Proccessing";
            $order->save();

            $item = Cart::findOrFail($item->id);
            $item->delete();
        }

        Session::flash('success', 'Payment successful!');

        return back();
    }

    public function show_order(){
        if(Auth::id()){
            $userId = Auth::user()->id;
            $orders = Order::where('user_id' , '=' , $userId)->get();
            $cart = Cart::all()->count();
            return view('home.orders',compact('orders' , 'cart') );
        }else{
            return redirect('login');
        }
    }

    public function del_order($id){
        $order = Order::findOrFail($id);
        $order->delivery_status = "Cancelled";
        $order->save();
        return redirect()->back()->with('message' , 'You deleted your order');
    }

    public function add_comment(Request $request){
        if(Auth::id()){
            $comment = new Comment;
            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment = $request->comment;

            $comment->save();
            return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    public function add_reply(Request $request){
        if(Auth::id()){
            $reply = new Reply;
            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->reply = $request->reply;
            $reply->comment_id = $request->commentId;

            $reply->save();
            return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    public function search_product(Request $request){

        $products = Product::where("title" , "LIKE" , "%$request->search%")->orWhere("cat" , "LIKE" , "%$request->search%")->paginate(10);
        $comments = Comment::orderby('id', 'desc')->get();
        $reply = Reply::orderby('id', 'desc')->get();
        $cart = Cart::all()->count();

        return view('home.userpage' , compact('products' , 'comments' , 'reply' , 'cart'));
    }

    public function show_products(){
        $products = Product::paginate(10);
        $cart = Cart::all()->count();
        return view('home.show_products' , compact('products' ,'cart'));
    }

    public function product_search(Request $request){

        $products = Product::where("title" , "LIKE" , "%$request->search%")->orWhere("cat" , "LIKE" , "%$request->search%")->paginate(10);
        $cart = Cart::all()->count();
        return view('home.show_products' , compact('products' ,'cart'));
    }

    public function show_blog(){
        $comments = Comment::orderby('id', 'desc')->get();
        $reply = Reply::orderby('id', 'desc')->get();
        $cart = Cart::all()->count();

        return view('home.blog' , compact('comments' , 'reply' , 'cart'));
    }

    public function subscribe(){
        return redirect('register');
    }

    public function log_in(){
        return redirect('login');
    }

    public function show_test(){
        $tests = Testim::all();
        $cart = Cart::all()->count();
        return view('home.testim' , compact('tests' , 'cart'));
    }
}
