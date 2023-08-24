<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Propietario extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $connection = 'mysql';
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'numero',
        'domicilio',
        'localidad',
        'municipio',
        'estado',
        'correo',
        'password',
    ];
    protected $hidden = [
        'password',
    ];
}
