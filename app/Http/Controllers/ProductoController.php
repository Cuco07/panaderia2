<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with(['marca', 'categorias'])
            ->latest()
            ->get();

        return view('producto.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::where('estado', true)->get();
        $marcas = Marca::where('estado', true)->get();

        return view('producto.create', compact('categorias', 'marcas'));
    }

    public function store(StoreProductoRequest $request)
    {
        $producto = Producto::create(
            $request->only([
                'nombre',
                'descripcion',
                'marca_id',
                'estado',
            ])
        );

        $producto->categorias()->sync($request->categorias);

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto creado correctamente');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::where('estado', true)->get();
        $marcas = Marca::where('estado', true)->get();

        $producto->load('categorias');

        return view(
            'producto.edit',
            compact('producto', 'categorias', 'marcas')
        );
    }

    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $producto->update(
            $request->only([
                'nombre',
                'descripcion',
                'marca_id',
                'estado',
            ])
        );

        $producto->categorias()->sync($request->categorias);

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(Producto $producto)
    {
        $producto->update([
            'estado' => ! $producto->estado
        ]);

        return redirect()
            ->route('productos.index')
            ->with('success', 'Estado del producto actualizado');
    }
}
