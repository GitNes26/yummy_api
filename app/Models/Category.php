<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'cat_id',
        'cat_name',
        'cat_description',
        'cat_active',
        'deleted_at'
    ];
    /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $table= "categories";
     /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $primaryKey="cat_id";

    /**
     * Get all of the products for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Products::class, 'cat_id', 'pro_cat_id');
    }

}
