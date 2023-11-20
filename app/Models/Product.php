<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'price',
        'status',
        'picture',
        'note',
        'original_quantity',
        'current_quantity',
        'reorder_level',
        'total_amount',
        'sale_amount',
        'category',
    ];
}
