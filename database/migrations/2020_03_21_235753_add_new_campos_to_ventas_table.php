<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewCamposToVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->text('nombre');
            $table->text('email');
            $table->text('telefono');
            $table->text('observacion');
            $table->enum('metodo_pago', ['Moneda', 'Efectivo','Transferencia','Tarjeta']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->text('nombre');
            $table->text('email');
            $table->text('telefono');
            $table->text('observacion');
            $table->enum('metodo_pago', ['Moneda', 'Efectivo','Transferencia','Tarjeta']);
        });
    }
}
