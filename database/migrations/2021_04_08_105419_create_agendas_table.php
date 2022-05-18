<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->bigIncrements('agendas_id');
            $table->string("agendas_title")->nullable();
            $table->longText("agendas_description")->nullable();
            $table->dateTime('agendas_date')->nullable();
            $table->bigInteger('calendars_id')->unsigned()->index()->nullable();
            $table->foreign('calendars_id')->references('calendars_id')->on('calendars')->onDelete('cascade');


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
        Schema::dropIfExists('agendas');
    }
}
