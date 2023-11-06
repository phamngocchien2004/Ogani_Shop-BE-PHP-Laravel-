<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Dotenv\Validator;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view("admin.pages.dashboard");
    }

    public function orders(){
        $orders = Order::orderBy("id","desc")->paginate(20);
        return view("admin.pages.orders",compact("orders"));
    }
    public function detailOrder(Order $order){
        return view("admin.pages.detailOrder",compact("order"));
    }
    public function products(){
        $products = Product::orderBy("created_at","desc")->paginate(12);
        return view("admin.pages.products",compact("products"));
    }
    public function create(){
        return view("admin.pages.create");
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'price' => 'required|decimal:2',
            'quantity'=>'required|numeric',
            'description'=>'nullable',
            'image'=>'sometimes|image:gif,png,jpeg'
        ]);

        if($validator->passes()){
            // save data
            $product =new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->description = $request->description;
            $product->save();


        } else {

        }


        return redirect(route("admin.products"));


    }
}
