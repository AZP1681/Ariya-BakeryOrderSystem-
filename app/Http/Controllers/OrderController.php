<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
 

class OrderController extends Controller
{
  

    public function InsertOrder(Request $request){
        $cart = session('cart', []);  
        $product_ids = array_keys($cart);
        $quantities = array_values($cart);
    
        $request->merge([
            'ordered_products' => implode(',', $product_ids),
            'ordered_quantity' => implode(',', $quantities),
        ]);

        $phone = str_replace(' ', '', $request->input('phone')); 
        $phone = str_pad($phone, 10, '0', STR_PAD_LEFT);

        $validatedData = $request->validate([
            'ordered_products' => 'required|string',
            'name' => 'required|string',
            'phone' => 'required|string|regex:/^[0-9]+$/', 
            'address' => 'required|string',
            'district' => 'required|string',
            'total_amount' => 'required|numeric',
            'pay_method' => 'required|integer', 
            'card_num' => 'nullable|integer',  
            'expire_date' => 'nullable|string', 
            'card_name' => 'nullable|string',
            'ordered_quantity' => 'required|string',
        ]); 

        $validatedData['phone'] = $phone;
 
 
        $order = Order::create([
            'ordered_products' => $request->ordered_products,
            'name' => $request->name,   
            'phone' => $validatedData['phone'],
            'address' => $request->address,
            'district' => $request->district,
            'total_amount' => $request->total_amount, 
            'pay_method' => $request->pay_method,
            'card_num' => $request->card_num,  
            'expire_date' => $request->expire_date,
            'card_name' => $request->card_name,
            'ordered_quantity' => $request->ordered_quantity,
        ]); 
     
        return response()->json([ 
            'message' => 'Order placed successfully!',
            'order' => $order,
        ]);
    }
}
