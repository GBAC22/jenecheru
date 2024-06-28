<?php

namespace App\Models;
use Controllers\SalidaController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    use HasFactory;

    protected $fillable=[       
        'fecha',        
        'status',
        'descripcion',
    ];

   
    public function dellateSalida()
    {
        return $this->hasMany(detalleSalida::class);
    }
}
