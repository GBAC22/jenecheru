<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ArticulosController extends Controller
{
    use WithFileUploads;

    //public $modalCrear = false;

    // Reglas de validación para los campos del formulario
    protected $rules = [
        'codigo' => 'required|string',
        'nombre' => 'required|string',
        'imagen',
        'tipo' => 'required|string',
        'precio_unitario' => 'required|numeric',
        'precio_mayor' => 'required|numeric',
        'precio_promedio' => 'nullable|numeric',
        'stock' => 'required|integer',
        'descripcion' => 'nullable|string'
    ];

    // Muestra una lista de artículos del inventario
    public function index()
    {
        $articulos = Articulo::all();
        return view('inventario.index', compact('articulos'));
    }

    // Muestra el formulario para crear un nuevo artículo del inventario
    public function create()
    {
        return view('inventario.create');
    }

    // Almacena un nuevo artículo del inventario en la base de datos
    public function store(Request $request)
    {
        $request->validate($this->rules);
        $input = $request->all();
        if ($file = $request->file('imagen')) {
            $nombreImagen = time() . '_' . $file->getClientOriginalName();
            $ruta = $file->storeAs('public/imagenes/articulos', $nombreImagen);
            $input['imagen'] = Storage::url($ruta);
        }
        Articulo::create($input);
        return redirect()->route('inventario.index')
            ->with('success', 'Artículo creado exitosamente.');
    }

    public function edit($id)
    {
        $articulo = Articulo::findOrFail($id);
        return view('inventario.edit', compact('articulo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->rules);
        $articulo = Articulo::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('imagen')) {
            $nombreImagen = time() . '_' . $file->getClientOriginalName();
            $ruta = $file->storeAs('public/imagenes/articulos', $nombreImagen);
            $input['imagen'] = Storage::url($ruta);
        } else {
            unset($input['imagen']);
        }
        $articulo->update($input);
        return redirect()->route('inventario.index')
            ->with('success', 'Artículo actualizado exitosamente.');
    }

    public function show($id)
    {
        $articulos = Articulo::findOrFail($id);
        return view('inventario.show', compact('articulos'));
    }

    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        if (!$articulo) {
            return redirect()->route('inventario.index')->with('error', 'El artículo no existe');
        }
        $articulo->delete();
        return redirect()->route('inventario.index')->with('success', 'Artículo eliminado correctamente');
    }
}
