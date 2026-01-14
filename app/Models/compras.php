<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class compras extends Model
{
    use HasFactory;

    public function provedore(){
        return $this->belongsTo(proveedore::class);
    }

   public function comprobante(){
        return $this->belongsTo(comprobante::class);
    }  

    public function productos(){
        return $this->belongsTo(producto::class)->withTimestamps()->withPivot('cantidad','precio_compra','precio_venta');
    } 
}
