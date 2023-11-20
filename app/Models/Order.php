<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_no',
        'customer_name',
        'total_amount',
        'discount_percent',
        'total_discount_amount',
        'payment_type',
        'payment_amount',
        'payment_change',
        'service_type',
        'order_status',
        'payment_status',
        'product_name',
        'quantity',
        'unit_price',
        'note',
        'order_seen',
        'update_count',
    ];
}
