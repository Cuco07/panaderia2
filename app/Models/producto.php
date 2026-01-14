<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\compra;
use App\Models\venta;
use App\Models\categoria;
use App\Models\marca;
use App\Models\Presentacion;
use Illuminate\Support\Facades\Storage;

class Producto extends Model
{
    use HasFactory; 

      public function compras(){
        return $this->belongsToMany(compras::class)->withTimestamps()->withPivot('cantidad','precio_compra','precio_venta');
    }

     public function ventas(){
        return $this->belongsToMany(ventas::class)->withTimestamps()->withPivot('cantidad','precio_venta','descuento');
    } 

     public function categorias(){
    return $this->belongsToMany(
        Categoria::class,
        'categorias_producto',   // nombre REAL de tu tabla pivote
        'producto_id',          // FK de producto
        'categoria_id'          // FK de categoria
    );
    }


     public function marca(){
        return $this->belongsTo(marca::class);
    }

     public function presentacion()
{
    return $this->belongsTo(Presentacion::class, 'presentacione_id');
}

    protected $fillable = ['codigo','nombre','descripcion','fecha_vencimiento','marca_id','presentacion_id','img_path','estado'];
    

    public function handleUploadImage($image){
        $file = $image;
        $name = time() . $file->getClientOriginalName();
       // $file->move(public_path(). '/img/productos/', $name);
       Storage::putFileAs('/public/productos/',$file,$name,'public'); 
        return $name;
    }
}
