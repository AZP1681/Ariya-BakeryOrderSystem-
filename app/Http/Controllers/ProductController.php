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
}
 