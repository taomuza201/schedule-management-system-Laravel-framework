<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->bigIncrements('districts_id');
            $table->string('districts_name')->unique(); // ชื่อตำบล
         
            $table->bigInteger('faculties_id')->unsigned()->index()->nullable();
            $table->foreign('faculties_id')->references('faculties_id')->on('faculties')->onDelete('cascade');
            $table->string('districts_faculty_branch')->nullable();  // ชื่อวิชาเอก สาขา


            
      
            $table->string('districts_prefix')->nullable();  // คำนำหน้า
            $table->string('districts_fname')->nullable(); //ชื่อ
            $table->string('districts_lname')->nullable(); //นามสกุล
            $table->string('districts_license_plate')->nullable(); //ป้ายทะเบียน

            $table->string('districts_distance')->nullable(); //ป้ายทะเบียน
            $table->string('districts_pic')->nullable(); //รูป
            $table->string('districts_map')->nullable(); //สถานที่

          

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
        Schema::dropIfExists('districts');
    }
}
