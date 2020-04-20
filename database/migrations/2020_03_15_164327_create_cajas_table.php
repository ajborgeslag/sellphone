<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('saldo_dollar',8,2);
            $table->double('saldo_pesos',8,2);
            $table->double('saldo_final',8,2);
            $table->text('observacion');
            $table->dateTime('fecha');
            $table->enum('concepto', ['Ingreso', 'Egreso']);
            $table->bigInteger('venta_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('venta_id')->references('id')->on('ventas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cajas');
    }
}
