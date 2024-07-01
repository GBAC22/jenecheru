<?php

namespace App\Http\Controllers;

use App\Models\Articulo;


use App\Models\Salida;


use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use PDF;
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
   
     

        $salida= Salida::create($request->all()+[
        
            'user_id'=> Auth::user()->id,
            'fecha'=>Carbon::now(),
        ]);

        foreach($request->articulo_id as $key => $articulo)
        {
            $results[] = array(
                'articulo_id' => (int) $articulo,
                'cantidad' => (int) $request->cantidad[$key],
                'detalle' => $request->detalle[$key],
                'precio' => (float) $request->precio[$key],);
        }               
        
        $salida->detalleSalidas()->createMany($results);
      
        
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

  
    public function destroy(int $salid)
    {
        $salida = Salida::find($salid);
        //$salida->articulos()->detach();       
        $salida->delete();
        return redirect()->route('salidas.index')->with('success', 'Nota Salida eliminado exitosamente');
    }
    public function pdf(Salida $salida)
    {
        $subtotal=0;
        $detalleSalidas=$salida->detalleSalidas;
        foreach($detalleSalidas as $detalleSalida){
          $subtotal += $detalleSalida->cantidad * $detalleSalida->precio;
        }
        $pdf= PDF::loadView('salidas.pdf', compact('salida','detalleSalidas','subtotal'));
        return  $pdf->download('Reporte de Nota de Salida'.$salida->id. '.pdf');
    }


    public function change_status(Salida $salida)
{
    if ($salida->status == 'PENDIENTE') {   
        $salida->update(['status' => 'VALIDO']);

        foreach ($salida->detalleSalidas as $detalle) {
            $articulo = Articulo::find($detalle->articulo_id);
            $articulo->stock -= $detalle->cantidad;
            $articulo->save();
        }

        return redirect()->back()->with('success', 'Salida activa y stock actualizado.');
    
    }else if ($salida->status == 'VALIDO') {
      
        $salida->update(['status' => 'CANCELADO']);

       
        foreach ($salida->detalleSalidas as $detalle) {
            $articulo = Articulo::find($detalle->articulo_id);
            $articulo->stock += $detalle->cantidad;
            $articulo->save();
        }

        return redirect()->back()->with('success', 'Salida cancelado y stock actualizado.');
    } else {
      
        $salida->update(['status' => 'PENDIENTE']);

  

        return redirect()->back()->with('success', 'Salida PENDIENTE y stock actualizado.');
    }
}
    
    public function descrip(Salida $salida)
    {
        if($salida->descripcion=='ARTICULO OBSOLETO')
        {
            $salida->update(['descripcion'=>'ARTICULO DAÑADO']);
            return redirect()->back();
        }else{
            $salida->update(['descripcion'=>'ARTICULO OBSOLETO']);
            return redirect()->back();
        }
    }

}
