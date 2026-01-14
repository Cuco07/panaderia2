<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class comprobante extends Model
{
    use HasFactory;

    public function compras(){
        return $this->hasMany(compras::class);
    }

     public function ventas(){
        return $this->hasMany(venta::class);
    }


}
