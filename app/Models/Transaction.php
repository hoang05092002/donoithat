<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'username',
        'user_id',
        'user_phone',
        'amount',
        'payment',
        'payment_info',
        'message',
        'security_code',
    ];
}
