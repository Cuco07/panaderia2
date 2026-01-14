<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'nombre',
        'cantidad',
        'unidad',
        'precio',
        'estado',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
