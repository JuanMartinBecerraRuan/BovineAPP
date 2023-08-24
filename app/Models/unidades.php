<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unidades extends Model
{
    use HasFactory;
    protected $table = 'unidades';
    protected $fillable = [
        'nombre',
        'latitud',
        'longitud',
        'upp',
        'domicilio',
        'localidad',
        'municipio',
        'estado',
        'id_propietario'
    ];

    public function propietario()
    {
        return $this->belongsTo(Propietario::class, 'id_propietario');
    }
}
