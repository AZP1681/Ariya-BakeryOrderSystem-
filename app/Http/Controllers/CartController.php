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
        ]); 

      
        $cart = session('cart', []);

        
        $product_id = $request->input('product_id');
        if (!in_array($product_id, $cart)) {
            $cart[] = $product_id; // Add to the cart
        }

        session(['cart' => $cart]);

        return response()->json([
            'message' => 'Product added to cart!',
            'cart' => $cart
        ]);
    }

    public function showCart(Request $request)
    {
      $product_ids = session('cart',[]);

      $products = Product::whereIn('id', $product_ids)->get();  
      return view('cart', compact('products'));  

    }
}
