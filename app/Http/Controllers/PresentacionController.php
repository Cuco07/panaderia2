<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePresentacionRequest;
use App\Http\Requests\UpdatePresentacionRequest;
use App\Models\Presentacion;
use App\Models\Caracteristica;
use Illuminate\Support\Facades\DB;
use Exception;

class PresentacionController extends Controller
{
    public function index()
    {
        $presentaciones = Presentacion::with('caracteristica')->latest()->get();
        return view('presentacion.index', compact('presentaciones'));
    }

    public function create()
    {
        return view('presentacion.create');
    }

    public function store(StorePresentacionRequest $request)
    {
        try {
            DB::beginTransaction();

            $caracteristica = Caracteristica::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'estado' => 1
            ]);

            Presentacion::create([
                'caracteristica_id' => $caracteristica->id
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()
            ->route('presentaciones.index')
            ->with('success', 'Presentación registrada');
    }

    public function edit(Presentacion $presentacion)
    {
        return view('presentacion.edit', compact('presentacion'));
    }

    public function update(UpdatePresentacionRequest $request, Presentacion $presentacion)
    {
        Caracteristica::where('id', $presentacion->caracteristica->id)
            ->update($request->validated());

        return redirect()
            ->route('presentaciones.index')
            ->with('success', 'Presentación actualizada');
    }

    public function destroy(string $id)
    {
        $message ='';
        $presentacion = Presentacion::find($id);
        if($presentacion->caracteristica->estado == 1){
         Caracteristica::where('id',$presentacion->caracteristica->id)
        ->update([
            'estado' => 0
        ]); 
        $message = 'Presentacion Eliminada'; 
        }else{
           Caracteristica::where('id',$presentacion->caracteristica->id)
        ->update([
            'estado' => 1
        ]);  
         $message = 'Presentacion Restaurada'; 
        }
        

        return redirect()->route('presentaciones.index')->with('success', $message);
    }
}
