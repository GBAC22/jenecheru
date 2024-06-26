<?php

namespace App\Http\Controllers;
use App\Models\Articulo;

use App\Models\User;
use App\Models\Salida;
use App\Http\Requests\StoreSalidaRequest;
use App\Http\Requests\UpdateSalidaRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SalidaController extends Controller
{
   
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $salidas = Salida::all();
        return view('salida.index', compact('salidas'));
    }

   
    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $articulos = Articulo::all();
        return view('salida.create',compact('articulos'));
    }


    public function store(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salidas= Salida::create($request->all());

        foreach($request->articulo_id as $key => $articulo)
        {
            $results[] = array("articulo_id"->$request->articulo_id[$key],
            "cantidad"->$request->cantidad[$key],
            "descripcion"->$request->descripcion[$key]
            );
        }               
        
        $salidas->detalleSalida()->createMany($results);
        // $salidas->save();
        
        return redirect()->route('salida.index');
    }

  
    public function show(Salida $salida)
    {
       // $salidas = Salida::findOrFail($salida);      
        return view('salida.show', compact('salida'));
    }

   
    public function edit(Salida $salida)
    {
        $users=User::get();
        return view('salida.show',compact('salida'));
    }


    public function update(UpdateSalidaRequest $request, Salida $salida)
    {
        //
    }

  
    public function destroy(Salida $salida)
    {
        //
    }
}
