<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaDevolucion extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'descripcion',
        'user_id',
    ];

    public function usuario(){
        return $this->belongsTo(User::class);
    }
}
