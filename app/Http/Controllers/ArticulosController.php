<?php

namespace App\Http\Controllers;

use App\Models\marca;
use App\Models\Modelo;
use Livewire\Component;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Events\ArticuloViewed;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Bitacora;

class ArticulosController extends Controller
{
    use WithFileUploads;

    // Reglas de validación para los campos del formulario
    protected $rules = [
        'codigo' => 'required|string',
        'nombre' => 'required|string',
        'imagen',
        'precio_unitario' => 'required|numeric|min:0',
        'precio_mayor' => 'required|numeric|min:0',
        'precio_promedio' => 'nullable|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'descripcion' => 'nullable|string',

        'categoria_id' => 'required|exists:categorias,id',
        'marca_id' => 'required|exists:marcas,id',
        'modelo_id' => 'required|exists:modelos,id'
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
        $categorias = Categoria::all();
        $marcas = marca::all();
        $modelos = Modelo::all();

        return view('inventario.create', compact('categorias', 'marcas', 'modelos'));
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

        return redirect()->route('inventario.index')->with('success', 'Artículo creado exitosamente.');
    }

    public function edit($id)
    {
        $articulo = Articulo::findOrFail($id);
        $categorias = Categoria::all();
        $marcas = marca::all();
        $modelos = Modelo::all();

        return view('inventario.edit', compact('articulo', 'categorias', 'marcas', 'modelos'));
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
        return redirect()->route('inventario.index')->with('success', 'Artículo actualizado exitosamente.');
    }

    public function show($id)
    {
        $articulo = Articulo::with(['categoria', 'marca', 'modelo'])->findOrFail($id);
        event(new ArticuloViewed($articulo));
        return view('inventario.show', compact('articulo'));
    }


    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        if (!$articulo) {
            return redirect()->route('inventario.index')->with('error', 'El artículo no existe');
        }
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Eliminacion de articulo',
                'details' => 'El articulo ' . $articulo->nombre . ' ha sido eliminado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }
        $articulo->delete();
        return redirect()->route('inventario.index')->with('success', 'Artículo eliminado correctamente');
    }



    public function home()
    {
        $articulos = Articulo::all();
        return view('pagos.checkout', compact('articulos'));
    }

    //añade al carrito
    public function addToCart(Request $request)
    {
        $id = $request->input('id');
        $quantity = $request->input('quantity', 1);

        $articulo = Articulo::findOrFail($id);

        $cartItems = session()->get('cartItems', []);

        if (isset($cartItems[$id])) {
            $cartItems[$id]['quantity'] += $quantity;
        } else {
            $cartItems[$id] = [
                'id' => $articulo->id,
                'name' => $articulo->nombre,
                'price' => $articulo->precio_unitario,
                'quantity' => $quantity,
                'image' => $articulo->imagen,
            ];
        }

        session()->put('cartItems', $cartItems);

        return redirect()->back()->with('success', 'Artículo agregado al carrito.');
    }

    public function cart()
    {
        $cartItems = session()->get('cartItems', []);
        return view('pagos.carrito-index', compact('cartItems'));
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->route('pagos.carrito-index')->with('success', '¡Carrito actualizado!');
        }

        return redirect()->route('pagos.carrito-index')->with('error', '¡Artículo no encontrado en el carrito!');
    }

    // CartController.php
    public function removeFromCart(Request $request)
    {
        $id = $request->input('id');
        $cartItems = session()->get('cartItems', []);

        if (isset($cartItems[$id])) {
            unset($cartItems[$id]);
            session()->put('cartItems', $cartItems);
            return redirect()->route('pagos.carrito-index')->with('success', '¡Artículo eliminado del carrito!');
        }

        return redirect()->route('pagos.carrito-index')->with('error', '¡Artículo no encontrado en el carrito!');
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->route('articulos.index')->with('success', '¡Carrito vaciado!');
    }
}
