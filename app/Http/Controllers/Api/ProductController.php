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
        if ($product->stuck>=$request->stuck and $request->stuck>=1){
            if (auth()->user()->balance>=$product->price){
                $order=Order::create([
                    'order_unique_code'=>Str::random(20),
                    'paid_amount'=>$product->price,
                    'user_id'=>auth()->user()->id
                ]);
                $user=User::find(auth()->user()->id);
                $user->balance=$user->balance-$product->price;
                $user->update();
                $newstuck=Product::find($product->id);
                $newstuck->stuck=$newstuck->stuck-$request->stuck;
                $newstuck->update();
                $order->product()->attach([
                    'product_id'=>$product->id,
                ]);
                return response(['message'=>'თქვენი შეკვეთა მიღებულია']);
            }else{
                return response(['message'=>'თქვენ არ გაქვთ საკმარისი თანხა']);
            }
        }else{
            return response(['message'=>'სამწუხაროდ არაა ხელმისაწვდომი პროდუქტის მითითებული რაოდენობა ან არასწორად მიუთითეთ სასურველი რაოდენობა', 'available'=>$product->stuck ]);

        }
    }
}
