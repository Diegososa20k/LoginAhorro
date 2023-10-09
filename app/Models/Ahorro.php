<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ahorro extends Model
{
    protected $fillable = ['nombre', 'porcentaje', 'ahorro', 'gasto', 'descripcion', 'resultadoAcumulados'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
