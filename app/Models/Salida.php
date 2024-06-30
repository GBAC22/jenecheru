<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    use HasFactory;

    protected $fillable=[       
        'fecha',  
        'total',      
        'status',
        'descripcion',        
    ];

   
    public function detalleSalida()
    {
        return $this->hasMany(detalleSalida::class);
    }

}
