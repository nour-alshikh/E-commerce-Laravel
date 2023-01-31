<?php

namespace App\Http\Controllers;

use PDF;
use Notification;
use App\Models\Cat;
use App\Models\User;
use App\Models\Order;
use App\Models\Testim;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\sendEmailNotification;

class AdminController extends Controller
{
    public function view_cat(){
        if(Auth::id()){

            $data = Cat::all();
            return view('admin.cat' , compact('data'));
        }else{
            return redirect('login');
        }
    }

    public function add_cat(Request $request){
        if(Auth::id()){
            $data = new Cat;

            $data->cat_name = $request->name;
            $data->save();

            return redirect()->back()->with('create_message', 'Category Added Successfully');
        }else{
            return redirect('login');
        }
    }

    public function del_cat($id){
        if(Auth::id()){
            $data = Cat::findOrFail($id);
            $data->delete();
            return redirect()->back()->with('del_message' , 'Category Deleted Successfully');
        }else{
        return redirect('login');
        }
    }

    public function edit_cat($id){
        if(Auth::id()){
            $data = Cat::findOrFail($id);
            return view('admin.editcat', compact('data'));
        }else{
            return redirect('login');
        }
    }

    public function update_cat(Request $request){
        if(Auth::id()){
            Cat::findOrFail($request->id)->update([
                "cat_name"=> $request->name,
            ]);
            $data = Cat::all();
            return view('admin.cat' , compact('data'));
        }else{
            return redirect('login');
        }
    }

    public function view_product(){
        if(Auth::id()){
            $cats= Cat::all();
            return view('admin.product' ,compact('cats'));
        }else{
            return redirect('login');
        }
    }

    public function add_product(Request $request){
        if(Auth::id()){
            $product = new Product;
            $product->title = $request->title;
            $product->desc = $request->desc;
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->quantity = $request->quantity;
            $product->cat = $request->cat;

            $image = $request->image;
            $image_name = time() . "." .$image->getClientOriginalExtension();
            $request->image->move('products' , $image_name);
            $product->image = $image_name;

            $product->save();

            return redirect()->back()->with('message', 'Product Added Successfully');
        }else{
            return redirect('login');
        }
    }

    public function show_product(){
        if(Auth::id()){
            $products = Product::all();
            return view('admin.show_product' ,compact('products'));
        }else{
            return redirect('login');
        }
    }

    public function delete_product($id){
        if(Auth::id()){
            $product = Product::findOrFail($id);
            $product->delete();
            return redirect()->back()->with('del_message' , 'Product Deleted Successfully');
        }else{
            return redirect('login');
        }
    }

    public function edit_product($id){
        if(Auth::id()){
            $product=Product::findOrFail($id);
            $cats=Cat::all();
            return view('admin.edit_product', compact('product' , 'cats'));
        }else{
            return redirect('login');
        }
    }

    public function update_product(Request $request ,$id){
        if(Auth::id()){
            $product = Product::findOrFail($id);
                $product->title=$request->title;
                $product->desc=$request->desc;
                $product->price=$request->price;
                $product->discount_price=$request->discount_price;
                $product->quantity=$request->quantity;
                $product->cat=$request->cat;
            ;

            $image = $request->image;
            if($image){
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $request->image->move('products' , $image_name);
                $product->image=$image_name;

            }

            $product->save();

            $products = Product::all();

            return view('admin.show_product' , compact('products'))->with('update_message' , 'Product Updated Successfully');
        }else{
            return redirect('login');
        }
    }

    public function order(){
        if(Auth::id()){
            $orders = Order::all();
            return view('admin.orders' , compact('orders'));
        }else{
            return redirect('login');
        }
    }

    public function deliver($id){
        if(Auth::id()){
            $order = Order::findOrFail($id);
            $order->delivery_status = "Delivered";
            $order->payment_status = "Paid";
            $order->save();
            return redirect()->back()->with('message' , 'Order Delivered Successfully');
        }else{
            return redirect('login');
        }
    }

    public function print_order($id){
        if(Auth::id()){
            $order = Order::findOrFail($id);
            $pdf = PDF::loadView('admin.pdf', compact('order'));
            return $pdf->download('order.pdf');
        }else{
            return redirect('login');
        }
    }

    public function send_email($id){
        if(Auth::id()){
            $order = Order::findOrFail($id);
            return view('admin.send_email', compact('order'));
        }else{
            return redirect('login');
        }
    }

    public function send_user_email(Request $request , $id){
        if(Auth::id()){
            $order = Order::findOrFail($id);

            $details=[
                'greeting' => $request->greeting,
                'first_line' => $request->first_line,
                'body' => "thanks for shopping here",
                'button' => $request->button,
                'url' => $request->url,
                'last_line' => $request->last_line
            ];

            Notification::send($order , new sendEmailNotification($details));
            return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    public function search(Request $request){
        if(Auth::id()){
            $order = $request->search;
            $orders = Order::where("name" , "LIKE" , "%$order%")
                            ->orWhere("email" , "LIKE" , "%$order%")
                            ->orWhere("product_title" , "LIKE" , "%$order%")
                            ->orWhere("address" , "LIKE" , "%$order%")
                            ->orWhere("payment_status" , "LIKE" , "%$order%")
                            ->orWhere("delivery_status" , "LIKE" , "%$order%")
                            ->orWhere("price" , "LIKE" , "%$order%")->get();
            return view("admin.orders" , compact("orders"));
        }else{
            return redirect('login');
        }
    }

    public function add_testim(){
        if(Auth::id()){
            $testims = Testim::all();
            return view('admin.add_testim' , compact('testims'));
        }else{
            return redirect('login');
        }
    }

    public function store_testim(Request $request){
        if(Auth::id()){
            $testim = new Testim();
            $testim->name = $request->name;
            $testim->testimonial = $request->testim;

            $image = $request->image;
            $image_name = time() . "." .$image->getClientOriginalExtension();
            $request->image->move('products' , $image_name);
            $testim->image = $image_name;

            $testim->save();
            return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    public function del_testim($id){
        if(Auth::id()){
            $testim = Testim::findOrFail($id);
            $testim->delete();
            return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    public function show_users(){
        if(Auth::id()){
          $users = User::where('id', '!=' ,'2')->get();
            return view('admin.users', compact('users'));
        }else{
            return redirect('login');
        }
    }

    public function add_admin($id){
        if(Auth::id()){
          $user = User::findOrFail($id);
          $user->usertype = '1';
          $user->save();
            return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    public function remove_admin($id){
        if(Auth::id()){
          $user = User::findOrFail($id);
          $user->usertype = '0';
          $user->save();
            return redirect()->back();
        }else{
            return redirect('login');
        }
    }

}
