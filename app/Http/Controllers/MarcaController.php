<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarcaRequest;
use App\Http\Requests\UpdateMarcaRequest;
use App\Models\Marca;
use App\Models\Caracteristica;
use Illuminate\Support\Facades\DB;
use Exception;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $marcas = Marca::with('caracteristica')->latest()->get();

         return view('marca.index', ['marcas' => $marcas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marca.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMarcaRequest $request)
{
    Marca::create($request->validated());

    return redirect()
        ->route('marcas.index')
        ->with('success', 'Marca creada correctamente');
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
    public function edit(Marca $marca)
    {
        return view('marca.edit',['marca' =>$marca]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMarcaRequest $request, Marca $marca)
{
    $marca->update($request->validated());

    return redirect()
        ->route('marcas.index')
        ->with('success', 'Marca actualizada');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca)
{
    $marca->update([
        'estado' => ! $marca->estado
    ]);

    return redirect()
        ->route('marcas.index')
        ->with('success', 'Estado de la marca actualizado');
}

}
