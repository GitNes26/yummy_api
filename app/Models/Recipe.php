<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'recipe_name',
        'product_id',
        'recipe_quantity',
        'measure_id',
        'row_material_id',
        'recipe_active'
    ];
     /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $table= "recipes";
     /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $primaryKey="recipe_id";

    
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','product_id');
    }
}