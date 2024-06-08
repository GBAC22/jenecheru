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

    public function getContent()
    {
        return [
            'id' => $this->id,
            'name' => $this->nombre,
            'price' => $this->precio_unitario,
            // Otros atributos del artículo que desees incluir en el contenido del carrito
        ];
    }
}
