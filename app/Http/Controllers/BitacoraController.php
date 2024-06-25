<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;

use App\Models\User;
use Illuminate\Http\Request;
class BitacoraController extends Controller
{
    
    public function showBitacora($userId)
    {
        $user = User::findOrFail($userId);
        $bitacoras = Bitacora::where('user_id', $userId)->get(); // pasa la lista completa

        $currentDateTime = now()->format('Y-m-d H:i:s');

        return view('bitacora.show', compact('user', 'bitacoras', 'currentDateTime'));
    }
    
}
