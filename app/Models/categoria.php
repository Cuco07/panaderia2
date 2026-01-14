<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public function productos(){
        return $this->belongsToMany(
        Producto::class,
        'categorias_producto',   
        'categoria_id',          
        'producto_id'            
    );
    }

    public function caracteristica(){
        return $this->belongsTo(Caracteristica::class);
    }

    protected $fillable = ['caracteristica_id',
    'estado'];
}


