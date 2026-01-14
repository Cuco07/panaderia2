<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'marca_id',
        'estado',
    ];

    /* =====================
       Relaciones
    ====================== */

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function categorias()
    {
        return $this->belongsToMany(
            Categoria::class,
            'categorias_producto'
        );
    }

    public function presentaciones()
    {
        return $this->hasMany(Presentacion::class);
    }
}
