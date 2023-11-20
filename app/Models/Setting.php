<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_name',
        'business_tin',
        'address',
        'contact_no',
        'email',
        'url',
        'logo',
        'auth_key',
        'daily_report_hour',
    ];
}
