<?php

namespace App\Http\Livewire\Inventario;

use Livewire\Component;
use App\Models\Articulo;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;

class ArticuloCreate extends Component
{


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

    public function render()
    {
        return view('livewire..inventario.articulo-create');
    }
}
