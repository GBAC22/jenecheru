<?php

namespace App\Http\Controllers;
// use App\Http\Requests\UpdateSalidaRequest;
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
        return view('salidas.index', compact('salidas'));
    }

   
    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $articulos = Articulo::all();
        return view('salidas.create',compact('articulos'));
    }


    public function store(Request $request)
    {
   
        // $request->validate([
        //     'articulo_id' => 'required|array',
        //     'articulo_id.*' => 'exists:articulos,id',
        //     'cantidad' => 'required|array',
        //     'cantidad.*' => 'integer|min:1',
        //     'detalle' => 'required|array',
        //     'detalle.*' => 'string|max:255',
        //     'precio' => 'required|array',
        //     'precio.*' => 'numeric|min:0',
        // ]);

        $salida= Salida::create($request->all()+[
            'fecha'=>Carbon::now()
        ]);

        foreach($request->articulo_id as $key => $articulo)
        {
            $results[] = array(
                'articulo_id' => (int) $articulo,
                'cantidad' => (int) $request->cantidad[$key],
                'detalle' => $request->detalle[$key],
                'precio' => (float) $request->precio[$key],);
        }               
        
        $salida->detalleSalida()->createMany($results);
      
        
        return redirect()->route('salidas.index')->with('success','Nota de Salida creado exitosamente');
    }

  
    public function show(Salida $salida)
    {
        $subtotal=0;
        $detalleSalidas=$salida->detalleSalidas;
        foreach($detalleSalidas as $detalleSalida){
          $subtotal += $detalleSalida->cantidad * $detalleSalida->precio;
        }
        return view('salidas.show', compact('salida','detalleSalidas','subtotal'));
    }

   
    public function edit(Salida $salida)
    {    
        return view('salidas.show',compact('salida'));
    }


    public function update(UpdateSalidaRequest $request, Salida $salida)
    {
        //
    }

  
    public function destroy(int $salid)
    {
        $salida = Salida::find($salid);
        //$salida->articulos()->detach();       
        $salida->delete();
        return redirect()->route('salidas.index')->with('success', 'Nota Salida eliminado exitosamente');
    }
}
