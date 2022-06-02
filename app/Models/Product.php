<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'category_id',
        'product_price',
        'product_active',
    ];
    /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $table= "products";
     /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $primaryKey="product_id";

    
    public function recipe()
    {
        return $this->belongsTo(Recipe::class,'product_id','product_id');
    }
}
