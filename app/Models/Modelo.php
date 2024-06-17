<?php

namespace App\Models;

use App\Models\Articulo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Events\ModeloCreated;
use App\Events\ModeloUpdated;

class Modelo extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($modelo) {
            if (!app()->runningInConsole()) {
                event(new ModeloCreated($modelo));
            }
        });

        static::updated(function ($modelo) {
            if (!app()->runningInConsole()) {
                event(new ModeloUpdated($modelo));
            }
        });
    }

    public function articulos()
    {
        return $this->hasMany(Articulo::class);
    }
}
