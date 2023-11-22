<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard');
    }

    public function total_sale($day) {
        try {
            switch ($day) {
                case 'today':
                    $total = Order::select(DB::raw('SUM(total_discount_amount) AS total'))
                                ->whereDate('created_at', '=', now()->toDateString())
                                ->where('payment_status', 'Paid')
                                ->first(); 
                    echo '<span class="text-green-600">₱ </span>' . number_format($total->total, 2);
                    break;
                case 'last-7-days':
                    $total = Order::select(DB::raw('SUM(total_discount_amount) AS total'))
                                ->whereDate('created_at', '>=', Carbon::now()->subDays(7)->toDateString())
                                ->where('payment_status', 'Paid')
                                ->first(); 
                    echo '<span class="text-green-600">₱ </span>' . number_format($total->total, 2);
                    break;
                case 'last-30-days':
                    $total = Order::select(DB::raw('SUM(total_discount_amount) AS total'))
                                ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString())
                                ->where('payment_status', 'Paid')
                                ->first(); 
                    echo '<span class="text-green-600">₱ </span>' . number_format($total->total, 2);
                    break;
                default:
                    $total = Order::select(DB::raw('SUM(total_discount_amount) AS total'))
                                ->whereDate('created_at', '=', Carbon::now()->subDays(1)->toDateString())
                                ->where('payment_status', 'Paid')
                                ->first(); 
                    echo '<span class="text-green-600">₱ </span>' . number_format($total->total, 2);
                    break;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function total_customer($day) {
        try {
            switch ($day) {
                case 'today':
                    $total = Order::select(DB::raw('COUNT(*) AS total'))
                                ->whereDate('created_at', '=', now()->toDateString())
                                ->first();
                    echo $total->total;
                    break;
                case 'last-7-days':
                    $total = Order::select(DB::raw('COUNT(*) AS total'))
                                ->whereDate('created_at', '>=', Carbon::now()->subDays(7)->toDateString())
                                ->first();
                    echo $total->total;
                    break;
                case 'last-30-days':
                    $total = Order::select(DB::raw('COUNT(*) AS total'))
                                ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString())
                                ->first();
                    echo $total->total;
                    break;
                default:
                    $total = Order::select(DB::raw('COUNT(*) AS total'))
                                ->whereDate('created_at', '=', Carbon::now()->subDays(1)->toDateString())
                                ->first();
                    echo $total->total;
                    break;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function total_product() {
        $product = Product::select(DB::raw('COUNT(*) AS total'))
                    ->first();
        echo $product->total;
    }

    public function product_sale() {
        $product = Product::select(DB::raw('SUM(sale_amount) AS total')) 
                    ->first();
        echo '<span class="text-green-600">₱ </span>' . number_format($product->total, 2);
    }

    public function average_order() { 
        $order = Order::select(DB::raw('AVG(total_discount_amount) AS average_order_value'))
                    ->where('order_status', 'served')
                    ->where('payment_status', 'Paid')
                    ->whereDate('created_at', '=', Carbon::now()->subDays(1)->toDateString())
                    ->first(); 
        echo '<span class="text-green-600">₱ </span>' . number_format($order->average_order_value, 2);
    }

    public function pending_order() {
        $order = Order::select(DB::raw('COUNT(*) AS total'))
                    ->where('order_status', '')
                    ->first();
        echo $order->total;
    }

    public function unpaid_order() {
        $order = Order::select(DB::raw('COUNT(*) AS total'))
                    ->where('payment_status', 'Unpaid')
                    ->first();
        echo $order->total;
    }

    public function product_reorder() {
        $product = Product::select(DB::raw('COUNT(*) AS total'))
                    ->where('current_quantity', '<=', 'reorder_level')
                    ->first(); 
        echo $product->total;
    }

    public function product_low() {
        $product = Product::select(DB::raw('COUNT(*) AS total'))
                    ->where('current_quantity', '>', 'reorder_level')
                    ->where('current_quantity', '<', DB::raw('reorder_level + 10'))
                    ->first();
        echo $product->total;
    }

    public function out_stock() {
        $product = Product::select(DB::raw('COUNT(*) AS total'))
                    ->where('current_quantity', 0)
                    ->first(); 
        echo $product->total;
    }

    public function total_staffs() {
        $user = User::select(DB::raw('COUNT(*) AS total'))
                    ->where('role', 'staff')
                    ->first();
        echo $user->total;
    }

    public function product_best() {
        $product = Product::select('product_name', DB::raw('SUM(total_amount) as total_amount'))
                    ->groupBy('product_name')
                    ->orderByDesc('total_amount')
                    ->first(); 
        echo $product->product_name;
    }

    public function unavailable_product() {
        $product = Product::select(DB::raw('COUNT(*) AS total'))
                    ->where('status', 'unavailable')
                    ->first(); 
        echo $product->total; 
    }

    public function available_product() {
        $product = Product::select(DB::raw('COUNT(*) as total'))
                    ->where('status', 'available')
                    ->first();
        echo $product->total;
    }
}
