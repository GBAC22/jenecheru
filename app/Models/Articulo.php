<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'imagen',
        'tipo',
        'precio_unitario',
        'precio_mayor',
        'precio_promedio',
        'stock',
        'descripcion'
    ];
}
