<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'mysql';
    public function up(): void
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('latitud');
            $table->decimal('longitud');
            $table->string('upp', 12);
            $table->string('domicilio');
            $table->string('localidad');
            $table->string('municipio');
            $table->string('estado');
            $table->timestamps();
            $table->unsignedBigInteger('id_propietario');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unidad_de_produccion');
    }
};
