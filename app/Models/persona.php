<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class persona extends Model
{
    use MasFactory;
    public function documento(){
        return $this->belongsTo(Documento::class);
    }
    public function proveedore(){
        return $this->hasOne(proveedore::class);
        } 
    public function cliente(){
        return $this->hasOne(cliente::class);
        }     
}
