<?php

namespace App\Models;

use App\Models\Modelo;
use App\Models\Categoria;
use App\Models\marca;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Articulo extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'imagen',
        'precio_unitario',
        'precio_mayor',
        'precio_promedio',
        'stock',
        'descripcion',

        'categoria_id',
        'marca_id',
        'modelo_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function marca()
    {
        return $this->belongsTo(marca::class);
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }

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
