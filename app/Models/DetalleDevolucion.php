<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleDevolucion extends Model
{
    use HasFactory;
    protected $fillable = [
        'cantidad',
        'precio',
        'importe',
        'estado',
        'articulo_id',
        'nota_devolucion_id',
    ];

    public function articulo(){
        return $this->belongsTo(Articulo::class);
    }
}
