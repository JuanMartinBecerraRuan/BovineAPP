<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prueba extends Model
{
    use HasFactory;
    protected $connection = 'mysql_tertiary';
    protected $table = 'pruebas';
    protected $fillable = [
        'nombre', 
        'tipo', 
        'descripcion', 
        'inyeccion', 
        'lectura', 
        'no_animales', 
        'id_propietario'
    ];

    public function detalles() {
        return $this->hasMany(Detalle::class, 'id_prueba', 'id');
    }

    public function propietario()
    {
        return $this->belongsTo(Propietario::class, 'id_propietario');
    }
}
