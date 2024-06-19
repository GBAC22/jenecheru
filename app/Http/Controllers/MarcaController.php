<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarcaRequests;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Gate;
use App\Models\marca;
use Illuminate\Support\Facades\Storage;


class MarcaController extends Controller
{


    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $marcs = marca::all();
        return view('marca.index', compact('marcs'));
    }


    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('marca.create');
    }

    public function store(Request $request)
    {

        $request->validate([

            'nombre' => 'required|string|min:1|max:200',
            'creacion' => 'required|string|min:1',
            'imagen' => 'required|image|mimes:jpeg,png,svg,jpg|max:1024'
        ]);
    
        $input=$request->all();
        if($imagen = $request->file('imagen'))
        {            
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis'). "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $input['imagen'] = "$imagenProducto";    
            
        }
        marca::create($input);
        return redirect()->route('marca.index')->with('success','Marca creado exitosamente');
    }
    
    public function show(int $id)
    {

        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $marc = marca::findOrFail($id);
        return view('marca.show', compact('marc'));
    }


    public function edit(int $id)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $marc = marca::find($id);
        return view('marca.edit', compact('marc'));
    }


    public function update(Request $request, int $id)
    {
        $request->validate([
            'nombre' => 'required', 'creacion' => 'required'
        ]);
        $marc = marca::findOrFail($id);
         $input = $request->all();
         if ($imagen = $request->file('imagen')) {         
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis') . "." . $imagen->getClientOriginalExtension(); 
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $input['imagen'] = "$imagenProducto";

        } else {
            unset($input['imagen']);
        }
         $marc->update($input);
         return redirect()->route('marca.index')->with('success','Marca modificado exitosamente');

    }


    public function destroy(int $id)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $marc = marca::find($id);
        $marc->delete();
        return redirect()->route('marca.index')->with('success', 'Marca eliminado exitosamente');
    }
}
