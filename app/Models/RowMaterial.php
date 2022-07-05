<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RowMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'rm_name',
        'rm_measure_unity',
        'rm_prov_id',
        'rm_unity_quantity',
        'rm_stock',
        'rm_unit_price',
        'rm_active'
    ];
    /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $table= "row_materials";
     /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $primaryKey="rm_id";

    /*
         * Get the user that owns the Product
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'rm_prov_id', 'prov_id');
    }
}
