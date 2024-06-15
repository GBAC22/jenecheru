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
        $bitacoras = Bitacora::where('user_id', $userId)->paginate(5); // Pagina cada registro por hoja

        $currentDateTime = now()->format('Y-m-d H:i:s');

        $pdf = PDF::loadView('bitacora.pdf', compact('user', 'bitacoras', 'currentDateTime'));

        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('isPhpEnabled', true);
        return $pdf->download('bitacora.pdf');
    }
    
}
