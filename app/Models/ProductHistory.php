<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 
        'transaction_type',
        'transaction_count',
        'updated_quantity',
    ];
}
