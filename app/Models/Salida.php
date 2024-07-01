<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    use HasFactory;

    protected $fillable=[  
        'user_id',
        'fecha',  
        'total',      
        'status',
        'descripcion',        
    ];

   
    public function detalleSalidas()
    {
        return $this->hasMany(detalleSalida::class);
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }

}
