<?php

namespace App\Models;

use App\Models\Articulo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Modelo extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion'];

    public function articulos()
    {
        return $this->hasMany(Articulo::class);
    }
}
