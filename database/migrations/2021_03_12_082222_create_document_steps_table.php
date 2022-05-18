<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_steps', function (Blueprint $table) {
            $table->bigIncrements('document_steps_id');
            $table->bigInteger('document_steps_no'); //ขั้นตอนที่ 1
            $table->string('document_steps_name'); //ชื่อขั้นตอน
            $table->bigInteger('document_steps_upload')->default(0) ;//อัพโลหดไฟล์
            $table->bigInteger('faculties_id')->unsigned()->index()->nullable(); //อ้างอิงไปยังคณะ
            $table->foreign('faculties_id')->references('faculties_id')->on('faculties')->onDelete('cascade');

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
        Schema::dropIfExists('document_steps');
    }
}
