<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
   

    public function addToCart(Request $request)
    {
        
        $request->validate([
            'product_id' => 'required|exists:products,id', 
            'quantity' => 'required|integer|min:1',
        ]); 

      
        $cart = session('cart', []);

        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        if (isset($cart[$product_id])) {
            $cart[$product_id] += 1;  // Increase quantity if exists
        } else {
            $cart[$product_id] = 1;   // Add new product
        }
    

        session(['cart' => $cart]);

        return response()->json([
            'message' => 'Product added to cart successfully',
            'cart' => $cart
        ]);

    }

    public function updateQuantity(Request $request){
        $request->validate([
            'product_id' => 'required|exists:products,id', 
            'quantity' => 'required|integer|min:1',
        ]); 

        $cart = session('cart', []);

        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        if (isset($cart[$product_id])) {
            $cart[$product_id] = $quantity;  
        }

         
        session(['cart' => $cart]);
    
        return response()->json([
            'message' => 'Quantity updated successfully',
            'cart' => $cart 
        ]);

    }

    public function showCart(Request $request)
    {
        $cart = session('cart', []); 

        $product_ids = array_keys($cart); 
    
        $products = Product::whereIn('id', $product_ids)->get();  
    
        return view('cart', compact('products', 'cart'));  

    }
}
