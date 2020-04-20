<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCelularesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('celulares', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->bigInteger('color_id')->unsigned();
            $table->foreign('color_id')->references('id')->on('colores');
			$table->bigInteger('capacidad_id')->unsigned();
            $table->foreign('capacidad_id')->references('id')->on('capacidades');
			$table->bigInteger('marca_id')->unsigned();
            $table->foreign('marca_id')->references('id')->on('marcas');
			$table->bigInteger('modelo_id')->unsigned();
            $table->foreign('modelo_id')->references('id')->on('modelos');
			$table->text('vendedor');
			$table->text('comprador')->nullable();
			$table->text('imei');
			$table->date('fecha_compra');
			$table->date('fecha_venta')->nullable();
			$table->double('precio_compra',8,2);
			$table->double('precio_venta',8,2)->nullable();
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
        Schema::dropIfExists('celulares');
    }
}
