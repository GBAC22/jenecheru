<?php

namespace App\Http\Livewire\Inventario;

use App\Models\Articulo;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;

class ArticuloIndex extends Component
{
    //public $modalCrear = false;
    public $articulos = [];

    //public function crearArticulo(){dd("boton crear presionado");}

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


    // Muestra una lista de artículos del inventario
    public function index()
    {
        $articulos = Articulo::all();
        return view('livewire..inventario.articulo-index', compact('articulos'));
    }

    public function render()
    {
        return view('livewire..inventario.articulo-index');
    }



}
