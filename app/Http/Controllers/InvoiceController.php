<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function print(Request $request)
    {
        $cartItems = session()->get('cart', []);
        
        // Calcular el total
        $total = array_reduce($cartItems, function($carry, $item) {
            return $carry + $item['price'] * $item['quantity'];
        }, 0);

        return view('pagos.invoice', compact('cartItems', 'total'));
    }
}
