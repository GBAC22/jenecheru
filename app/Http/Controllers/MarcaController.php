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
        // marca::create($request->all());
        $input=$request->all();
        if($imagen = $request->file('imagen'))
        {
            // $guardarImagen= 'imagen/';
            // $imagenM=date('YmdHis'). "." . $imagen->getClientOriginalExtension();
            // $ruta = $imagen->storeAs('public/imagenes/marcas', $imagenM);
            // $imagen->move($guardarImagen, $imagenM);
            // $input['imagen'] = Storage::url($ruta);
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $ruta = $imagen->storeAs('public/imagenes/marcas', $nombreImagen);
            $input['imagen'] = Storage::url($ruta);
            
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
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $ruta = $imagen->storeAs('public/imagenes/marcas', $nombreImagen);
            $input['imagen'] = Storage::url($ruta);
        } else {
            unset($input['imagen']);
        }
         $marc->update($input);
         return redirect()->route('marca.index')->with('success','Marca modificado exitosamente');




        // $request->validate([
        //     'nombre' => 'required|string|min:1|max:200',
        //     'creacion' => 'required|string|min:1'
        // ]);

        // $marc = marca::find($id);
        // $marc->update($request->all());
        // return redirect()->route('marca.index')->with('success','Marca modificado exitosamente'); //sa
    }


    public function destroy(int $id)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $marc = marca::find($id);
        $marc->delete();
        return redirect()->route('marca.index')->with('success', 'Marca eliminado exitosamente');
    }
}
