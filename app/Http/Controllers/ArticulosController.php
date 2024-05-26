<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use Livewire\Component;
use Livewire\WithFileUploads;

class ArticulosController extends Controller
{
    public function index(){
        return view('inventario.index');
    }

    // Reglas de validación para los campos del formulario
    protected $rules = [
        'codigo' => 'required',
        'nombre' => 'required',
        'imagen' => 'required|image',
        'tipo' => 'required',
        'precio_unitario' => 'required',
        'precio_mayor' => 'required',
        'precio_promedio' => 'required',
        'stock' => 'required',
        'descripcion'
    ];


    // Muestra el formulario para crear un nuevo artículo del inventario
    public function create()
    {
        return view('livewire..inventario.articulo-create');
    }

    // Almacena un nuevo artículo del inventario en la base de datos
    public function store(Request $request)
    {
        $request->validate($this->rules);
        Articulo::create($request->all());
        return redirect()->route('livewire..inventario.articulo-index');
    }




}
