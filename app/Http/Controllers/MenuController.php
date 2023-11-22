<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product; 
use Illuminate\Http\Request; 

class MenuController extends Controller
{
    public function index() {
        $products = fn($category) => Product::where('category', $category)->get();

        return view('menu', [
            'products' => $products
        ]);
    }

    public function ready_receipt(Request $req) {
        session([
            'total' => $req->total,
            'data' => $req->data,
            'customer' => $req->customer,
            'service' => $req->service,
            'payment_amount' => $req->payment_amount,
            'payment_change' => $req->payment_change,
            'note' => $req->note,
            'discount' => $req->discount,
            'invoice_no' => rand(1, 999)
        ]); 

        return response()->json(['status' => 'success']);
    } 

    public function place_order(Request $req) {
        $name = "";
        $price = "";
        $quantity = "";

        foreach (session('data') as $value) {
            $name .= $value['name'] . ', ';
            $price .= $value['price'] . ', ';
            $quantity .= $value['quantity'] . ', ';
        } 

        $no = Order::where('invoice_no', session('invoice_no'))->get(); 
        if ($no->count() > 0) {
            session(['invoice_no' => rand(1, 999)]);
        }

        $discount = floatval(session('total')) * floatval(session('discount')) / 100; 
        $grandtotal = floatval(session('total')) - abs($discount); 
        $payment_status = empty(session('payment_amount')) && session('payment_amount') == '' ? 'Unpaid' : 'Paid';
        
        if (session('payment_amount') > 0 && session('payment_amount') < $grandtotal) {
            $payment_status = 'Balance';
        }

        $payment_amount = session('payment_amount') == '' ? 0 : session('payment_amount');

        $save = Order::create([
            'payment_change' => session('payment_change'),
            'customer_name' => session('customer'),
            'invoice_no' => session('invoice_no'),
            'payment_type' => session('service'),
            'service_type' => session('service'),
            'total_amount' => session('total'),
            'note' => session('note'),
            'total_discount_amount' => $grandtotal,
            'payment_status' => $payment_status,
            'payment_amount' => $payment_amount,
            'product_name' => $name, 
            'quantity' => $quantity,
            'unit_price' => $price, 
        ]); 

        if ($save) {
            $this->unset_session_orders();
            return response()->json(['status' => 'success', 'msg' => 'Order placed.']); 
        }
    }

    public function unset_session_orders() {
        session()->forget([
            'total',
            'data',
            'customer',
            'service',
            'payment_amount',
            'payment_change',
            'note',
            'discount',
            'invoice_no'
        ]); 
    }
}
