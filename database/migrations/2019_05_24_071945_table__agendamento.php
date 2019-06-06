<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableAgendamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->integer('cliente');
            $table->integer('funcionario');
            $table->dateTime('hora_inicio');
            $table->dateTime('hora_final');
            $table->integer('servico');           
            $table->integer('solicitacao_agendamento');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamentos');
    }
}
