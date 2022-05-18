<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturers', function (Blueprint $table) {
            $table->bigIncrements('lecturers_id');
           
            $table->string('lecturers_prefix')->nullable();  // คำนำหน้า
            $table->string('lecturers_fname')->nullable(); //ชื่อ
            $table->string('lecturers_lname')->nullable(); //นามสกุล
            $table->string('lecturers_tel')->nullable();  // เบอร์โทร
            $table->string('lecturers_license_plate')->nullable(); //ป้ายทะเบียน
            $table->longtext('lecturers_expertise')->nullable(); //ความเชี่ยวชาญ

            $table->bigInteger('lecturer_types_id')->unsigned()->index()->nullable(); // ประเภทวิทยากร
            $table->foreign('lecturer_types_id')->references('lecturer_types_id')->on('lecturer_types')->onDelete('cascade');
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
        Schema::dropIfExists('lecturers');
    }
}
