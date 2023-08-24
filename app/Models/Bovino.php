<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bovino extends Model
{
    use HasFactory;
    protected $connection = 'mysql_secondary';
    protected $fillable = [
        'no_coqueta',
        'nombre',
        'edad',
        'raza',
        'sexo',
        'tipo',
        'fecha_nacimiento',
        'id_propietario',
        'foto',
    ];
    
    public function propietario()
    {
        return $this->belongsTo(Propietario::class, 'id_propietario');
    }
}
