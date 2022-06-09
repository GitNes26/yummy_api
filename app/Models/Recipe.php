<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'rec_name',
        'rec_pro_id',
        'rec_quantity_usage',
        'rec_measure',
        'rec_row_material_id',
        'rec_active'
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
    protected $primaryKey="rec_id";

    
    public function product()
    {
        return $this->belongsTo(Product::class,'rec_pro_id','pro_id');
    }
}