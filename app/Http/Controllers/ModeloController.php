<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;

class ModeloController extends Controller
{
 
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        // Obtener todos los modelos
        $modelos = Modelo::all();
        
        return view('modelos.index', compact('modelos'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        // Método para mostrar el formulario de creación
        return view('modelos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
        ]);

        // Crear el modelo utilizando los datos validados
        Modelo::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
        ]);

        return redirect()->route('modelos.index')->with('success', 'Modelo creado exitosamente.');
    }

    public function show(Modelo $modelo)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('modelos.show', compact('modelo'));
    }

    public function edit(Modelo $modelo)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // Método para mostrar el formulario de edición
        return view('modelos.edit', compact('modelo'));
    }

    public function update(Request $request, Modelo $modelo)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
        ]);

        // Actualizar el modelo utilizando los datos validados
        $modelo->update([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
        ]);

        return redirect()->route('modelos.index')->with('success', 'Modelo actualizado exitosamente.');
    }

    public function destroy(Modelo $modelo)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $modelo->delete();
        return redirect()->route('modelos.index')->with('success', 'Modelo eliminado exitosamente.');
    }
}
