<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'mysql_tertiary';
    public function up(): void
    {
        Schema::create('pruebas', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string('tipo');
            $table->text('descripcion');
            $table->date('inyeccion');
            $table->date('lectura');
            $table->unsignedBigInteger('no_animales');
            $table->timestamps();
            $table->unsignedBigInteger('id_propietario');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pruebas');
    }
};
