<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Product;
use Symfony\Component\CssSelector\Node\FunctionNode;
use App\Helpers\DriveHelper;

class ProductController extends Controller
{
     
    public function index()
    { 
        $products = Product::all();  
        return view('order', compact('products'));
    }
 
    public function search(Request $request){
        $search_txt = strtolower(str_replace(' ', '', $request->input('search')));
        $products = Product::whereRaw("LOWER(REPLACE(product_name, ' ', '')) LIKE ?", ["%{$search_txt}%"])->get();

        return view('order', compact('products'));
    }

    public function category_select(Request $request){
        $selected_type = $request->input('type');
    
        if ($selected_type == 'all') {
            $products = Product::all(); 
        } else {
            $products = Product::where('category', $selected_type)->get();
        }
    
        return view('order', compact('products'));
    
    }
}
 