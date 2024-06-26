<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleSalida extends Model
{
    use HasFactory;
    protected $fillable=[
        'salida_id',
        'articulo_id',
        'Cantidad',
        'descripcion',
    ];
  
    public function articulo()
    {
        return $this->belongsTo(Articulos::class);
    }
  
}
