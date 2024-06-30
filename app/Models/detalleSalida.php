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
        'cantidad',
        'detalle',
        'precio',
    ];
  
 
    public function salida()
    {
        return $this->belongsTo(Salida::class);
    }
    public function articulo()
    {
        return $this->belongsTo(Articulos::class);
    }
    
}
