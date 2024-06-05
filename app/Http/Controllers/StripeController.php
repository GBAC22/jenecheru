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
        Stripe::setApiKey(config('stripe.sk'));

        $ids_articulos = $request->input('articulo_id');
        $articulos = Articulo::whereIn('id', $ids_articulos)->get();

        $lineItems = [];
        foreach ($articulos as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->nombre,
                    ],
                    'unit_amount' => $item->precio_unitario * 100,
                ],
                'quantity' => 1,
            ];
        }

        $session = Session::create([
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('checkout'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        return redirect()->route('pagos.checkout')->with('success', 'Pago completado con éxito');
    }
}
