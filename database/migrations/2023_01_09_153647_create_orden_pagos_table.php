<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_pago', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idpostulante');
            $table->string('dni',20);
            $table->string('nombres',255);
            $table->string('servicio',5);
            $table->string('descripcion',255);
            $table->float('monto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_pago');
    }
}
