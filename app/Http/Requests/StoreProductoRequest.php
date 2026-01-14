<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'marca_id' => 'required|exists:marcas,id',
            'estado' => 'required|boolean',
            'categorias' => 'required|array|min:1',
            'categorias.*' => 'exists:categorias,id',
        ];
    }
}
