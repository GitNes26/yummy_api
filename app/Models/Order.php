<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden solicitar.
     * @var array<int, string>
     */
    protected $fillable = [
        'order_employee_id',
        'order_table_id',
        'order_bo_id',
        'order_os_id',
        'order_active',
        'delete_at'
    ];

    /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $table = 'orders';

    /**
     * LlavePrimaria asociada a la tabla.
     * @var string
     */
    protected $primaryKey = 'order_id';

    /**
     * Obtener el empleado relacionado a la nota.
     */
    public function user()
    {
        return $this->hasOne(User::class,'order_employee_id','id'); //primero se declara FK y despues la PK
    }
    /**
     * Obtener la mesa relacionado a la nota.
     */
    public function table()
    {
        return $this->hasOne(User::class,'order_table_id','id'); //primero se declara FK y despues la PK
    }

    /**
     * Valores defualt para los campos especificados.
     * @var array
     */
    // protected $attributes = [
    //     'role_active' => true,
    // ];
}
