<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index() {
        $orders = Order::where('payment_status', 'Paid')
                    ->orWhere('payment_status', 'Balance')
                    ->orderBy('order_status')
                    ->orderBy('updated_at')
                    ->get();  

        return view('transaction', [
            'orders' => $orders
        ]);
    }
}
