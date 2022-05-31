<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch_office extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables.
     * @var array<int,string>
     */
    protected $fillable = [
        'bo_name',
        'bo_country',
        'bo_state',
        'bo_city',
        'bo_address',
        'bo_active',
        'deleted_at'
    ];

    /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $table = 'branch_offices';

    /**
     * LlavePrimaria asociada a la tabla.
     * @var string
     */
    protected $primaryKey = 'bo_id';
}
