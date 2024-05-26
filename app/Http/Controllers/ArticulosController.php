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
    public $codigo, $nombre, $imagen, $tipo, $precio_unitario, $precio_mayor, $precio_promedio,
        $stock, $descripcion;

    // Reglas de validación para los campos del formulario
    protected $rules = [
        'codigo' => 'required|string',
        'nombre' => 'required|string',
        'imagen' => 'required|image',
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
        //obtener nombre de la imagen
        //$nombreImagen = time() . '_' . $this->imagen->getClientOriginalName();
        //ruta guardar la imagen
        //$ruta = $this->imagen->storeAs('public/imagenes/articulos', $nombreImagen);
        //donde esta guardada la imagen
        //$url = Storage::url($ruta);

        return view('inventario.create');
    }

    // Almacena un nuevo artículo del inventario en la base de datos
    public function store(Request $request)
    {
        $request->validate($this->rules);
        //obtener nombre de la imagen
        $nombreImagen = time() . '_' . $this->imagen->getClientOriginalName();
        //ruta guardar la imagen
        $ruta = $this->imagen->storeAs('public/imagenes/articulos', $nombreImagen);
        //donde esta guardada la imagen
        $url = Storage::url($ruta);

        //Articulo::create($request->all());
        Articulo::create([
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'imagen' => $url,
            'tipo' => $this->tipo,
            'precio_unitario' => $this->precio_unitario,
            'precio_mayor' => $this->precio_mayor,
            'precio_promedio' => $this->precio_promedio,
            'stock' => $this->stock,
            'descripcion' => $this->descripcion
        ]);

        $this->reset(['codigo', 'nombre', 'imagen', 'tipo', 'precio_unitario', 'precio_mayor', 'precio_promedio', 'stock', 'descripcion']);
        
        return redirect()->route('inventario.index');
    }




}
