<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function my_order(){
        $orders=auth()->user()->order;
        return response(['orders'=>$orders]);
    }
}
