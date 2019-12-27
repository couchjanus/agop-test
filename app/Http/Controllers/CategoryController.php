<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Response;

class CategoryController extends Controller
{
    public function getById($id)
    {
        $category = Category::with('products')->find($id);
        return Response::json($category);
    }

}
