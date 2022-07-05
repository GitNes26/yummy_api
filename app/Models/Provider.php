<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    protected $fillable = [
        'prov_name',
        'prov_country',
        'prov_state',
        'prov_city',
        'prov_suburb',
        'prov_address',
        'prov_phone_contact',
        'prov_contact_name',
        'prov_active',
    ];
    /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $table= "providers";
     /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $primaryKey="prov_id";
}
