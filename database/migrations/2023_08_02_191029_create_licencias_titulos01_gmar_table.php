<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenciasTitulos01GmarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_gente_de_mar')->create('licencias_titulos_gmar01', function (Blueprint $table) {
            $table->string('solicitud');
            $table->string('documento');
            $table->string('tipo_emision');
            $table->string('nro_ctrl')->nullable();
            $table->string('fecha_emision');
            $table->dateTime('fecha_vencimiento')->nullable();
            $table->string('ci')->nullable();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('estatus');
            $table->date('fecha_solicitud');
            $table->integer('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_gente_de_mar')->dropIfExists('licencias_titulos_gmar01');
    }
}
