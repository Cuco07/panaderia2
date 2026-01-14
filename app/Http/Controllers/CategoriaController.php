<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Categoria;
use App\Models\Caracteristica;
use Illuminate\Support\Facades\DB;
use Exception;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::latest()->get();

        return view('categoria.index', compact('categorias'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Almacena un recurso recién creado en el almacenamiento.
     */
    public function store(StoreCategoriaRequest $request)
    {
        Categoria::create($request->validated());

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoría creada correctamente');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {


        return view('categoria.edit', ['categoria' => $categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        $categoria->update($request->validated());

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoría actualizada');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoría eliminada');
    }
}
