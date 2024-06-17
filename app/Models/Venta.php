<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'cliente_id', 'fecha', 'total',
    ];

    public function articulos()
    {
        return $this->belongsToMany(Articulo::class)
                    ->withPivot('cantidad', 'precio_unitario')
                    ->withTimestamps();
    }
}
