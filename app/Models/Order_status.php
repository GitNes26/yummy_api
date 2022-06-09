<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_status extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'os_name',
        'os_active',
        'deleted_at'
    ];

    /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $table = 'order_status';

    /**
     * LlavePrimaria asociada a la tabla.
     * @var string
     */
    protected $primaryKey = 'os_id';

    /**
     * Obtener orden asociado con el status.
     */
    public function order()
    {   //primero se declara FK y despues la PK del modelo asociado
        return $this->belongsTo(Order::class,'order_id','order_id');
    }
}
