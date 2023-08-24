<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle extends Model
{
    use HasFactory;
    protected $connection = 'mysql_tertiary';
    protected $table = 'detalles';
    protected $fillable = [
        'id_bovino', 
        'id_prueba',
        'resultado'
    ];
}
