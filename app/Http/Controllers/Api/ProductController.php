<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function categories(){
        $categories=Category::with("product")->get();
        return response(['categories'=>$categories]);
    }


    public function purchase(Request $request, Product $product){
        
    }
}
