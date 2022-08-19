<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    use HasFactory;
    protected $fillable = [
        'od_order_id',
        'od_recipe_id',
        'od_unit_price',
        'od_quantity',
        'od_complement',
        'od_names'
    ];

    public function order_detail()
    {
        return $this->belongsTo([Order::class, Recipe::class], ['od_order_id','od_recipe_id']);
    }
}
