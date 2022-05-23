<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'role_name',
        'role_active',
        'deleted_at'
    ];

    /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $table = 'roles';

    /**
     * LlavePrimaria asociada a la tabla.
     * @var string
     */
    protected $primaryKey = 'role_id';

    /**
     * Obtener los usuarios relacionados a un rol.
     */
    public function users()
    {
        return $this->hasMany(User::class,'role_id','role_id'); //primero se declara FK y despues la PK
    }

    /**
     * Valores defualt para los campos especificados.
     * @var array
     */
    // protected $attributes = [
    //     'role_active' => true,
    // ];
}
