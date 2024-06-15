<?php

namespace App\Models;

use App\Models\Articulo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        
    ];

    public function articulos()
    {
        return $this->hasMany(Articulo::class);
    }
}
