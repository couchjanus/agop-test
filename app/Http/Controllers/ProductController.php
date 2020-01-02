<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Response;


class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::with('categories')->with('images')->get();
        return Response::json($products);
    }

    
 
}
