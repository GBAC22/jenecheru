<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;
class BitacoraController extends Controller
{
    
    
    public function generatePDF($userId)
    {
        $user = User::findOrFail($userId);
        $bitacoras = Bitacora::where('user_id', $userId)->get(); // pasa la lista completa

        $currentDateTime = now()->format('Y-m-d H:i:s');

        $pdf = PDF::loadView('bitacora.pdf', compact('user', 'bitacoras', 'currentDateTime'));

        return $pdf->download('bitacora.pdf');
    }
    
}
