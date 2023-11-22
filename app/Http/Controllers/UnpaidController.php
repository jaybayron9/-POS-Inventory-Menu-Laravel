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

    public function update_receipt(Request $req) {
        try { 
            foreach(Order::where('order_id', $req->order_id)->get() as $order) {
                $customer = explode(", ", $order->product_name);
                $name = array_filter($customer);

                $fquantity  = array_map('intval', explode(", ", $order->quantity));
                $quantity = array_filter($fquantity);

                $fprice  = array_map('intval', explode(", ", $order->unit_price));
                $price = array_filter($fprice);

                $data = [];
                for ($i = 0; $i < count($name); $i++ ) 
                    $data[$i] = array(
                        'purchase' => $name[$i] . ', ' . $quantity[$i] . ', ' . $price[$i],
                    ); 

                $new_array = array();
                foreach ($data as $item) {
                    $parts = explode(", ", $item['purchase']);
                    $name = substr($parts[0], 0);
                    $price = $parts[2];
                    $quantity = $parts[1];
                    $new_item = array(
                        "name" => $name,
                        "price" => $price,
                        "quantity" => $quantity
                    );
                    if (!in_array($new_item, $new_array)) 
                        $new_array[] = $new_item; 
                }

                session([
                    'data' =>  $new_array, 
                    'total' => $req->total,
                    'customer' => $order->customer_name,
                    'service' => $order->service,
                    'payment_amount' => $req->payment_amount,
                    'payment_change' => $req->change,
                    'discount' => $req->discount,
                    'invoice_no' => $order->invoice_no,
                    'create_at' => $order->created_at,
                ]);  
            }

            $total_discount = $req->total - $req->discount_amount;

            $payment_status = 'Paid';
            if ($req->payment_amount > 0 && $req->payment_amount < $req->total)
                $payment_status = 'Balance'; 

            Order::where('order_id', $req->order_id)->update([
                'payment_amount' => $req->payment_amount,
                'payment_change' => $req->change,
                'discount_percent' => $req->discount_amount,
                'total_discount_amount' => $total_discount,
                'payment_status' => $payment_status
            ]); 
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);
        } 
    }

    public function reissue_receipt(Request $req) {
        try {
            foreach (Order::where('order_id', $req->order_id) as $order) {
                $customer = explode(", ", $order->product_name);
                $name = array_filter($customer);

                $fquantity  = array_map('intval', explode(", ", $order->quantity));
                $quantity = array_filter($fquantity);

                $fprice  = array_map('intval', explode(", ", $order->unit_price));
                $price = array_filter($fprice);

                $data = [];
                for ($i = 0; $i < count($name); $i++ )
                    $data[$i] = array(
                        'purchase' => $name[$i] . ', ' . $quantity[$i] . ', ' . $price[$i],
                    ); 

                $new_array = array();
                foreach ($data as $item) {
                    $parts = explode(", ", $item['purchase']);
                    $name = substr($parts[0], 0);
                    $price = $parts[2];
                    $quantity = $parts[1];
                    $new_item = array(
                        "name" => $name,
                        "price" => $price,
                        "quantity" => $quantity
                    );
                    if (!in_array($new_item, $new_array)) 
                        $new_array[] = $new_item; 
                }

                session([
                    'data' => $new_array,
                    'total' => $order->total_amount,
                    'customer' => $order->customer_name,
                    'service' => $order->service_type,
                    'payment_amount' => $order-> payment_amount,
                    'payment_change' => $order->payment_change,
                    'discount_amount' => $order->discount_percent,
                    'invoice_no' => $order->invoice_no,
                    'created_at' => $order->created_at
                ]); 
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);
        }
    }

    public function unset_session():void {
        session()->forget([
            'data',
            'total',
            'customer',
            'service',
            'payment_amount',
            'payment_change',
            'discount_amount',
            'invoice_no',
            'discount',
        ]); 
    }
}
