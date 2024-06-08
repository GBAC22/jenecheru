<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function checkout()
    {
        $articulos = Articulo::all();
        return view('pagos.checkout', compact('articulos'));
    }

    public function session(Request $request)
    {
        // Asegúrate de que los IDs de los artículos y las cantidades se estén pasando correctamente desde el formulario
        $ids_articulos = $request->input('articulo_id');
        $articulos_quantities = $request->input('articulo_quantity');

        // Verifica si se han seleccionado artículos antes de continuar
        if (!$ids_articulos) {
            // Manejar la situación en la que no se han seleccionado artículos
            return redirect()->back()->with('error', 'No se han seleccionado artículos para comprar.');
        }

        Stripe::setApiKey(config('stripe.sk'));

        // Obtén los detalles de los artículos a partir de los IDs recibidos
        $articulos = Articulo::whereIn('id', $ids_articulos)->get();

        $lineItems = [];
        foreach ($articulos as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->nombre,
                    ],
                    'unit_amount' => $item->precio_unitario * 100, // Convertir el precio a centavos
                ],
                'quantity' => $articulos_quantities[$item->id],
            ];
        }

        // Crea la sesión de pago de Stripe
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('checkout'),
        ]);

        // Redirige al usuario a la página de pago de Stripe
        return redirect()->away($session->url);
    }

    public function success()
    {
        // Vaciar el carrito
        session()->forget('cart');

        return redirect()->route('pagos.checkout')->with('success', 'Pago completado con éxito');
    }
}
