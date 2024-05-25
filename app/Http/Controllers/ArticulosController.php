<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticulosController extends Controller
{
    public function index(){
        return view('inventario.index');
    }
}
