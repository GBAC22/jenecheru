<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Articulo;
use App\Models\Cliente; // Asegúrate de importar el modelo Cliente
use App\Models\User;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with(['articulos', 'cliente'])->get(); // Cargar relaciones 'articulos' y 'cliente'
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $clientes = User::all(); // Obtener todos los clientes
        $articulos = Articulo::all(); // Obtener todos los artículos
        return view('ventas.create', compact('clientes', 'articulos'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
            'articulos' => 'required|array',
            'articulos.*.cantidad' => 'required|integer|min:1',
            'articulos.*.precio_unitario' => 'required|numeric|min:0',
        ]);
    
        // Crear nueva venta
        $venta = Venta::create([
            'cliente_id' => $request->cliente_id,
            'fecha' => $request->fecha,
            'total' => 0, // Calcularemos el total más adelante
        ]);
    
        // Adjuntar artículos a la venta con cantidad y precio_unitario
        foreach ($request->articulos as $articuloId => $detalles) {
            $cantidad = $detalles['cantidad'];
            $precioUnitario = $detalles['precio_unitario'];
    
            // Calcular el importe para este artículo
            $importe = $cantidad * $precioUnitario;
    
            // Adjuntar el artículo a la venta con los detalles
            $venta->articulos()->attach($articuloId, [
                'cantidad' => $cantidad,
                'precio_unitario' => $precioUnitario,
                'importe' => $importe,
            ]);
    
            // Actualizar el total de la venta
            $venta->total += $importe;
        }
    
        // Guardar el total calculado de la venta
        $venta->save();
    
        return redirect()->route('ventas.index')->with('success', 'Venta creada correctamente');
    }

    public function show($id)
    {
        $venta = Venta::with(['articulos', 'cliente'])->findOrFail($id); // Cargar relaciones 'articulos' y 'cliente'
        return view('ventas.show', compact('venta'));
    }

    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        $clientes = User::all(); // Obtener todos los clientes
        $articulos = Articulo::all(); // Obtener todos los artículos
        return view('ventas.edit', compact('venta', 'clientes', 'articulos'));
    }

    public function update(Request $request, $id)
    {
        // Validar datos del formulario
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric',
            'articulos' => 'required|array',
            'articulos.*.id' => 'exists:articulos,id',
            'articulos.*.cantidad' => 'required|integer|min:1',
            'articulos.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        // Actualizar venta
        $venta = Venta::findOrFail($id);
        $venta->update([
            'cliente_id' => $request->cliente_id,
            'fecha' => $request->fecha,
            'total' => $request->total,
        ]);

        // Sincronizar artículos de la venta con cantidad y precio_unitario
        $venta->articulos()->detach(); // Primero eliminamos todas las relaciones existentes
        foreach ($request->articulos as $articulo) {
            $venta->articulos()->attach($articulo['id'], [
                'cantidad' => $articulo['cantidad'],
                'precio_unitario' => $articulo['precio_unitario'],
            ]);
        }

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente');
    }

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->articulos()->detach(); // Eliminar relaciones de artículos
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente');
    }
}
