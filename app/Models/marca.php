<?php

namespace App\Models;
use App\Models\Articulo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marca extends Model
{
    use HasFactory;

  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=[
        'id',
        'nombre',
        'creacion',
        'imagen',        
    ];

    public function articulos()
    {
        return $this->hasMany(Articulo::class);
    }
}
