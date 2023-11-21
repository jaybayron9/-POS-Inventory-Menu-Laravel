<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class UnpaidController extends Controller
{
    public function index() {
        $orders = Order::orderByRaw("
            CASE 
                WHEN payment_status = 'Unpaid' THEN 1
                WHEN payment_status = 'Balance' THEN 2
                WHEN payment_status = 'Paid' THEN 3
                ELSE 4 
            END, created_at
        ")->get();  

        return view('unpaid', [
            'orders' => $orders
        ]);
    }
}
