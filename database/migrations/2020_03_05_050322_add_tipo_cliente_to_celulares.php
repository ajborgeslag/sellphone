<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoClienteToCelulares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('celulares', function (Blueprint $table) {
            $table->enum('tipo_cliente', ['Mayorista', 'Minorista']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('celulares', function (Blueprint $table) {
           $table->dropColumn('tipo_cliente');
        });
    }
}
