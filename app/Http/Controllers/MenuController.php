<?php

namespace App\Http\Controllers;

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
}
