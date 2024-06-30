<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\Proveedor;
use App\Models\User;
use App\Models\Bitacora;

class PedidoController extends Controller
{
    
    public function index()
    {
        $pedidos = Pedido::with(['pedidos', 'user','proveedor'])->get();
        return view('pedidos.index', compact('pedidos'));
    }

    
    public function create()
    {
        $proveedores = Proveedor::all();
        $articulosConStockBajo = Articulo::where('stock', '<=', Pedido::getStockMinimo())->get();
        return view('pedidos.create', compact('proveedores', 'articulosConStockBajo'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'proveedor_id' => 'required|exists:proveedors,id',
            'estado' => 'required|string',
            'articulos' => 'required|array',
            'articulos.*.seleccionado' => 'nullable|boolean',
            'articulos.*.id' => 'required_if:articulos.*.seleccionado,true|exists:articulos,id',
            'articulos.*.cantidad' => 'required_if:articulos.*.seleccionado,true|integer|min:1',
            'articulos.*.precio_unitario' => 'required_if:articulos.*.seleccionado,true|numeric|min:0',
        ]);

        $user = auth()->user();

        $pedido = Pedido::create([
            'user_id' => $user->id,
            'proveedor_id' => $request->proveedor_id,
            'fecha' => now(),
            'estado' => $request->estado,
            'total' => 0,
        ]);
        if (auth()->check()) {
            Bitacora::create([
                'action' => 'Creación de pedido',
                'details' => 'El pedido de ' . $pedido->user->name . ' ha sido creado',
                'user_id' => auth()->user()->id,
                'ip_address' => request()->ip(),
            ]);
        }

        foreach ($request->articulos as $articulo) {
            if (isset($articulo['seleccionado']) && $articulo['seleccionado']) {
                $cantidad = $articulo['cantidad'];
                $precioUnitario = $articulo['precio_unitario'];
                $importe = $cantidad * $precioUnitario;

                $pedido->articulos()->attach($articulo['id'], [
                    'cantidad' => $cantidad,
                    'precio' => $precioUnitario,
                    'importe' => $importe,
                ]);

                $pedido->total += $importe;
            }
        }

        $pedido->save();

        

        return redirect()->route('pedidos.index')->with('success', 'Pedido creado correctamente');
    }


    public function setStockMinimo(Request $request)
    {
        $request->validate([
            'stock_minimo' => 'required|numeric|min:0',
        ], [
            'stock_minimo.required' => 'El campo stock mínimo es obligatorio.',
            'stock_minimo.numeric' => 'El campo stock mínimo debe ser un valor numérico.',
            'stock_minimo.min' => 'El stock mínimo debe ser mayor o igual a cero.',
        ]);
        $nuevoStockMinimo = $request->input('stock_minimo');
        Pedido::setStockMinimo($nuevoStockMinimo);

        return redirect()->back()->with('success', 'Stock mínimo actualizado correctamente.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
