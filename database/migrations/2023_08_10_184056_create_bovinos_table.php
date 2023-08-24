<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'mysql_secondary';
    public function up(): void
    {
        Schema::create('bovinos', function (Blueprint $table) {
            $table->id();
            $table->string('no_coqueta')->unique();
            $table->string('nombre');
            $table->integer('edad');
            $table->string('raza');
            $table->string('sexo');
            $table->string('tipo');
            $table->date('fecha_nacimiento');
            $table->unsignedBigInteger('id_propietario');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('bovinos');
    }
};
