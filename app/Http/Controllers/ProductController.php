<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Response;


class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::with('categories')->with('images')->with('brand')->get();
        return Response::json($products);
    }

    public function getProductsByCategory($id)
    {
        $products = Product::with('categories')->with('images')->get();
        $products = $products->reject(function ($product) use($id)  {
            return $product['categories'][0]->id!=$id;
        })
        ->map(function ($product) {
            return $product;
        });
        return Response::json($products);
    }

    public function getProductById($id)
    {
        $product = Product::where('id', $id)->with('categories')->with('images')->with('brand')->first();
        return Response::json($product);
    }

}
