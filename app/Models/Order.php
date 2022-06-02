<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_user_id',
        'order_table_id',
        'order_bo_id',
        'order_os_id',
        'order_active',
        'delete_at'
    ];
}
