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
        $orders = Order::select('id', 'name', 'phone', 'address', 'total_amount', 'ordered_products', 'ordered_quantity')->get();
        return response()->json($orders);
    } 


    public function fetch_order_detail(Request $request){
        $request->validate([
            'ordered_products' => 'required|string',
            'ordered_quantity' => 'required|string',
        ]);
    
      $product_ids = explode(',', $request->input('ordered_products'));
      $quantities = explode(',', $request->input('ordered_quantity'));
  
  
      $products = Product::whereIn('id', $product_ids)
          ->select('id', 'product_name', 'product_price', 'product_img_link')
          ->get();
  
      $ordered_items = [];
      foreach ($products as $index => $product) {
          $ordered_items[] = [
              'product' => $product,
              'quantity' => isset($quantities[$index]) ? (int) $quantities[$index] : 1
          ];
      }
  
      session([
        'ordered_items' => $ordered_items,
      ]);
      return response()->json(['success' => true]);

    }

    public function show_order_detail_page()
    {
      $ordered_items = session('ordered_items', []);
      return view('admin_order_detail', compact('ordered_items')); 
    }
} 
 