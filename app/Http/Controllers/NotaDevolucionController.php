<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Articulo;
use App\Models\DetalleDevolucion;
use App\Models\NotaDevolucion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class NotaDevolucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nota_devoluciones=NotaDevolucion::all();

        $devoluciones=new Collection();

        $devolucion=[];

        foreach($nota_devoluciones as $nota){
            $devolucion['id']=$nota->id;
            $devolucion['fecha']=$nota->fecha;
            $devolucion['descripcion']=$nota->descripcion;
            $detalles=DetalleDevolucion::where('nota_devolucion_id',$nota->id)->get();
            foreach($detalles as $detalle){
                $devolucion['cantidad']=$detalle->cantidad;
                $devolucion['precio']=$detalle->precio;
                $devolucion['importe']=$detalle->importe;
                $devolucion['estado']=$detalle->estado;
                $devolucion['articulo']=$detalle->articulo->nombre;
            }
            $devoluciones->push($devolucion);

        }
        return view('nota_devolucion.index',compact('devoluciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detalle_devolucion=new DetalleDevolucion();
        $usuario= User::pluck('name','id');
        $articulo= Articulo::pluck('nombre','id');

        return view('nota_devolucion.create',compact('detalle_devolucion','usuario','articulo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    // Validar los datos de entrada
    $request->validate([
        'fecha' => 'required|date',
        'descripcion' => 'required|string',
        'usuario_id' => 'required|integer',
        'cantidad' => 'required|integer',
        'precio' => 'required|numeric',
        'importe' => 'required|numeric',
        'estado' => 'required|string',
        'articulo_id' => 'required|integer',
    ]);

    // Crear la nota de devolución
    $nota_devolucion = NotaDevolucion::create([
        'fecha' => $request->fecha,
        'descripcion' => $request->descripcion,
        'user_id' => $request->usuario_id,
    ]);

    // Crear el detalle de devolución
    $detalle_devolucion = DetalleDevolucion::create([
        'cantidad' => $request->cantidad,
        'precio' => $request->precio,
        'importe' => $request->importe,
        'estado' => $request->estado,
        'articulo_id' => $request->articulo_id,
        'nota_devolucion_id' => $nota_devolucion->id,
    ]);
    $articulo=Articulo::where('id',$detalle_devolucion->articulo_id)->first();
    $cant=$articulo->stock;
    $articulo->stock=$cant+$detalle_devolucion->cantidad;
    $articulo->save();

    return redirect()->route('nota_devolucion.index')->with('success', 'Nota de devolución creada con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Busca la nota de devolución por su ID
        $nota_devolucion = NotaDevolucion::find($id);
    
        // Verifica si la nota de devolución existe
        if (!$nota_devolucion) {
            return redirect()->route('nota_devolucion.index')->with('error', 'La nota de devolución no existe.');
        }
    
        // Elimina primero todos los detalles asociados a esta nota de devolución
        DetalleDevolucion::where('nota_devolucion_id', $id)->delete();
    
        // Luego elimina la nota de devolución
        $nota_devolucion->delete();
    
        return redirect()->route('nota_devolucion.index')->with('success', 'Nota de devolución eliminada correctamente.');
    }
}
