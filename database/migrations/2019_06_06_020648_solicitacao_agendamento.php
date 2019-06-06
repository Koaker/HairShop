<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SolicitacaoAgendamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacao_agendamento', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->dateTime('datahora_solicitado');
            $table->integer('confirmado');
            $table->integer('rejeitado');
            $table->integer('cancelar');
            $table->integer('reagendar');
            $table->integer('cancelado');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitacao_agendamento');
    }
}
