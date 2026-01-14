<?php

namespace App\Http\Controllers;

use App\Models\Presentacion;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresentacionController extends Controller
{
    /**
     * Mostrar las presentaciones de un producto
     */
    public function index(Producto $producto)
    {
        $presentaciones = $producto->presentaciones()->latest()->get();

        return view('presentacion.index', compact('producto', 'presentaciones'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create(Producto $producto)
    {
        return view('presentacion.create', compact('producto'));
    }

    /**
     * Guardar una nueva presentación
     */
    public function store(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'nombre'    => 'required|string|max:100',
            'cantidad'  => 'nullable|integer|min:1',
            'unidad'    => 'nullable|string|max:20',
            'precio'    => 'required|numeric|min:0',
            'estado'    => 'required|boolean',
        ]);

        DB::transaction(function () use ($validated, $producto) {
            $producto->presentaciones()->create($validated);
        });

        return redirect()
            ->route('productos.presentaciones.index', $producto)
            ->with('success', 'Presentación creada correctamente');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Presentacion $presentacion)
    {
        return view('presentacion.edit', compact('presentacion'));
    }

    /**
     * Actualizar una presentación
     */
    public function update(Request $request, Presentacion $presentacion)
    {
        $validated = $request->validate([
            'nombre'    => 'required|string|max:100',
            'cantidad'  => 'nullable|integer|min:1',
            'unidad'    => 'nullable|string|max:20',
            'precio'    => 'required|numeric|min:0',
            'estado'    => 'required|boolean',
        ]);

        $presentacion->update($validated);

        return redirect()
            ->route('productos.presentaciones.index', $presentacion->producto)
            ->with('success', 'Presentación actualizada correctamente');
    }

    /**
     * Activar / Desactivar presentación
     */
    public function destroy(Presentacion $presentacion)
    {
        $presentacion->update([
            'estado' => ! $presentacion->estado
        ]);

        return redirect()
            ->route('productos.presentaciones.index', $presentacion->producto)
            ->with('success', 'Estado de la presentación actualizado');
    }
}
