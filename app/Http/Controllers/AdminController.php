<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\Order;
use App\Models\Cart;

class AdminController extends Controller
{

     
    public function fetch_orders_ajax(){
        $orders = Order::select('id', 'name', 'phone', 'address', 'total_amount', 'ordered_products', 'ordered_quantity')->get();
        return response()->json($orders);
    } 

    
    public function search_orders(Request $request){
        $search_txt = strtolower(str_replace(' ', '', $request->input('search')));
        $orders = Order::whereRaw("LOWER(REPLACE(name, ' ', '')) LIKE ?", ["%{$search_txt}%"])->get();
     
        return response()->json($orders);    
    }

    public function fetch_order_detail(Request $request){
        $request->validate([
            'ordered_products' => 'required|string',
            'ordered_quantity' => 'required|string',
            'order_id' => 'required|numeric',
        ]);
    
      $product_ids = explode(',', $request->input('ordered_products'));
      $quantities = explode(',', $request->input('ordered_quantity'));
      $the_id =  $request->input('order_id');

  
      $products = Product::whereIn('id', $product_ids)
       ->select('id', 'product_name', 'product_price', 'product_img_link')
       ->get()
       ->keyBy('id'); // Ensure correct order

    $ordered_items = [];
    foreach ($product_ids as $index => $id) {
        if (isset($products[$id])) {
            $ordered_items[] = [
                'product' => $products[$id],
                'quantity' => isset($quantities[$index]) ? (int) $quantities[$index] : 1,
                
            ]; 
        }
    }

  
      session([ 
        'ordered_items' => $ordered_items,
        'o_id' => $the_id
      ]);
      return response()->json(['success' => true]);
 
    }

    public function show_order_detail_page()
    {
      $ordered_items = session('ordered_items', []);
      $order_id = session('o_id', null);
      return view('admin_order_detail', compact('ordered_items')); 
    } 

    public function delete_order(Request $request)
    {
        $orderId = $request->input('order_id'); 
        $order = Order::find($orderId);
    
        if ($order) {  
            $order->delete();
            return response()->json(['success' => true]);
        }
       return response()->json(['success' => false, 'message' => 'Order not found.']);
    }











    //Products
    public function fetch_products_ajax(){
        $products = Product::select('id', 'product_name', 'product_desc', 'product_price', 'product_img_link', 'category')->get();
        return response()->json($products); 
    } 
    
    public function search_products(Request $request){
        $search_txt = strtolower(str_replace(' ', '', $request->input('search')));
        $products = Product::whereRaw("LOWER(REPLACE(product_name, ' ', '')) LIKE ?", ["%{$search_txt}%"])->get();
     
        return response()->json($products); 

    }
    public function delete_product(Request $request)
    {
        $productId = $request->input('product_id'); 
        $product = Product::find($productId);
    
        if ($product) {  
            $product->delete();
            return response()->json(['success' => true]);
        }
       return response()->json(['success' => false, 'message' => 'Product not found.']);
    } 

    public function add_product(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_desc' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'product_img_link' => 'required|string|max:255',
            'category' => 'required|string|max:255', 
        ]);
    
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->product_desc = $request->input('product_desc');
        $product->product_price = $request->input('product_price');
        $product->product_img_link = $request->input('product_img_link');
        $product->category = $request->input('category');
        $product->save();
    
        return response()->json(['success' => true]); 
    }


    public function update_product(Request $request)
    {
        $request->validate([
            'product_id' => 'required|numeric',
            'product_name' => 'required|string|max:255',
            'product_desc' => 'required|string|max:255',
            'product_price' => 'required|numeric',   
            'product_img_link' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ]); 
    
        $product = Product::find($request->input('product_id'));
    
        if ($product) {
            $product->product_name = $request->input('product_name');
            $product->product_desc = $request->input('product_desc');
            $product->product_price = $request->input('product_price');
            $product->product_img_link = $request->input('product_img_link');
            $product->category = $request->input('category');
            $product->save();
    
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false, 'message' => 'Product not found.']);
    }
} 
 