<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KitchenController extends Controller
{
    public function index() {
        $haveOrders = function() {
            $count = Order::whereNull('order_status')->count();  
            return $count === 0;
        };

        $orders = Order::whereNull('order_status')
                    ->orderBy('created_at')
                    ->get(); 

        return view('kitchen', [
            'haveOrders' => $haveOrders,
            'orders' => $orders
        ]);
    }
}
