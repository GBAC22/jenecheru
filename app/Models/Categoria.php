<?php

namespace App\Models;

use App\Models\Articulo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre'
    ];

    public function articulos()
    {
        return $this->hasMany(Articulo::class);
    }
}
