<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentPatternsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_patterns', function (Blueprint $table) {
            $table->bigIncrements('document_patterns_id');
            $table->string('document_patterns_name');
            $table->bigInteger('document_types_id')->unsigned()->index()->nullable();
            $table->foreign('document_types_id')->references('document_types_id')->on('document_types')->onDelete('cascade');
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
        Schema::dropIfExists('document_patterns');
    }
}
