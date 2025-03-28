<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;

class AdminController extends Controller
{
    public function fetch_products(){
        $products = Product::all();  
        return view('admin_products', compact('products'));
    }
    
    public function fetch_orders_ajax(){
        $orders = Order::select('id', 'name', 'phone', 'address', 'total_amount')->get();
        return response()->json($orders);
    } 
} 
