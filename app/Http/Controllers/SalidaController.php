<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateSalidaRequest;
use App\Models\Articulo;


use App\Models\Salida;


use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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


    public function store(UpdateSalidaRequest $request)
    {

        // fecha_hora' => 'required',
        //     'impuesto' => 'required',
        //     'numero_comprobante' => 'required|unique:ventas,numero_comprobante|max:255',
        //     'total' => 'required|numeric',
        //     'cliente_id' => 'required|exists:clientes,id',
        //     'user_id' => 'required|exists:users,id',

       
        
        $salidas= Salida::create($request->all()+[
            'fecha'=>Carbon::now()
        ]);

        foreach($request->articulo_id as $key => $articulo)
        {
            $results[] = array(
            "articulo_id"=>$request->articulo_id[$key],
            "cantidad"=>$request->cantidad[$key]);
        }               
        
        $salidas->detalleSalida()->createMany($results);
      
        
        return redirect()->route('salida.index');
    }

  
    public function show(Salida $salida)
    {
       // $salidas = Salida::findOrFail($salida);      
        return view('salida.show', compact('salida'));
    }

   
    public function edit(Salida $salida)
    {    
        return view('salida.show',compact('salida'));
    }


    public function update(UpdateSalidaRequest $request, Salida $salida)
    {
        //
    }

  
    public function destroy(int $salida)
    {
        $salidas = Salida::find($salida);       
        $salidas->delete();
        return redirect()->route('salida.index')->with('success', 'Salida eliminado exitosamente');
    }
}
