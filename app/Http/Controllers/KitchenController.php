<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product; 

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

    public function order_serve($order_id) {
        try {
            $orders = Order::where('order_id', $order_id);
            $orders->update([
                'order_status' => 'served'
            ]);

            $products = Product::all();
            foreach($orders->get() as $order) {
                if (strpos($order->product_name, '+') !== false) { 
                    $filteredOrderNameArray = [];
                    $filteredOrderQuantityArray = [];
                    $filteredOrderPriceArray = [];

                    foreach (explode(", ", $order->product_name) as $index => $name) {
                        if (strpos($name, '+') === 0) {
                            $filteredOrderNameArray[] = $name;
                            $filteredOrderQuantityArray[] = explode(", ", $order->quantity)[$index];
                            $filteredOrderPriceArray[] = explode(", ", $order->unit_price)[$index];
                        }
                    }

                    $filteredOrderNameArray = explode(", ", implode(", ", $filteredOrderNameArray));
                    $filteredOrderNameArray = array_map(function($item) {
                        return ltrim($item, '+');
                    }, $filteredOrderNameArray);

                    for ($i = 0; $i < count($filteredOrderNameArray); $i++) {
                        foreach ($products as $product) {
                            if ($filteredOrderNameArray[$i] == $product->product_name) {
                                $newSale = (int)$product->sale_amount + ((int)$product->price * (int)$filteredOrderQuantityArray[$i]);
                                $newQuantity = (int)$product->current_quantity - (int)$filteredOrderQuantityArray[$i];
                                $newTotal = $product->price * $newQuantity;

                                $newSale = strval($newSale);
                                $newQuantity = strval($newQuantity);
                                $newTotal = strval($newTotal);

                                Product::where('product_name', $filteredOrderNameArray[$i])->update([
                                    'sale_amount' => $newSale,
                                    'current_quantity' => $newQuantity,
                                    'total_amount' => $newTotal
                                ]);   
                            }
                        }
                    }
                }

                $data = explode(', ', $order->product_name);
                $quantity = explode(', ', $order->quantity);

                for ($i = 0; $i < count($data); $i++) {
                    foreach ($products as $product) {
                        if ($data[$i] == $product->product_name) {
                            $newSale = (int)$product->sale_amount + ((int)$product->price * (int)$quantity[$i]);
                            $newQuantity = (int)$product->current_quantity - (int)$quantity[$i];
                            $newTotal = $product->price * $newQuantity;

                            Product::where('product_name', $data[$i])->update([
                                'sale_amount' => $newSale,
                                'current_quantity' => $newQuantity,
                                'total_amount' => $newTotal
                            ]);  
                        }
                    }
                }

            }
            
            return response()->json([
                'status' => 'success',
                'msg' => 'Order mark as served'
            ]); 
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }   
    }

    public function order_cancel($order_id) {
        try {
            Order::where('order_id', $order_id)->delete();

            return response()->json([
                'status' => 'success', 
                'msg' => 'Order canceled.'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }   
    }
}
