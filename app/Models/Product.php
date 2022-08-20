<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'pro_name',
        'pro_cat_id',
        'pro_price',
        'pro_active',
        'description',
        'pathPhoto',
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
    protected $primaryKey="pro_id";

    
    public function recipe()
    {
        return $this->belongsTo(Recipe::class,'pro_id','rec_pro_id');//primero se declara FK y despues la PK
    }
    /*
         * Get the user that owns the Product
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'pro_cat_id', 'cat_id');
    }
}
