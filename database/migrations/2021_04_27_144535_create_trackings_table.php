<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {


            $table->bigIncrements('trackings_id');

            $table->bigInteger('trackings_number')->nullable();  //	เลขทะเบียนส่งs

            $table->bigInteger('users_id')->unsigned()->index()->nullable(); // คนที่สร้างเอกสาร
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('document_patterns_id')->unsigned()->index()->nullable(); //รูปแบบ เอกสาร หรือชื่อเรื่อง
            $table->foreign('document_patterns_id')->references('document_patterns_id')->on('document_patterns')->onDelete('cascade');

            $table->bigInteger('districts_id')->unsigned()->index()->nullable(); // อ้างอิงตำบล
            $table->foreign('districts_id')->references('districts_id')->on('districts')->onDelete('cascade');

            $table->string('trackings_mhesi')->nullable(); //เลขที่ อว
            $table->date('trackings_mhesi_date')->nullable(); //เลขที่ อว
            $table->string('trackings_registration_number')->nullable(); //เลขทะเบียนส่ง
            $table->string('trackings_name')->nullable(); //ชื่อเรื่อง
            $table->string('trackings_to')->nullable(); //ถึง

            $table->longText('trackings_detail')->nullable(); //ถึง

            $table->bigInteger('trackings_main')->default(0); 
            $table->date('trackings_main_date')->nullable(); 
            $table->string('trackings_recipient')->nullable();  //ผู้รับเอกสาร / เลขรับ

            $table->bigInteger('trackings_sub_1')->default(0); 
            $table->date('trackings_sub_1_date')->nullable(); 

            $table->bigInteger('trackings_sub_2')->default(0); 
            $table->date('trackings_sub_2_date')->nullable(); 

            $table->bigInteger('trackings_sub_3')->default(0); 
            $table->date('trackings_sub_3_date')->nullable(); 

            $table->bigInteger('trackings_status')->default(0);   //  0  = ผ่าน  | 1  = ไม่ผ่าน
            $table->longText('trackings_canceltext')->nullable();    //ข้อความยกเลิก
            $table->date('trackings_status_cancel')->nullable();  // วันที่ถูกยกเลิก



            $table->string('trackings_upload_1')->nullable();
            $table->string('trackings_upload_name_1')->nullable();

            $table->string('trackings_upload_2')->nullable();
            $table->string('trackings_upload_name_2')->nullable();

            $table->string('trackings_upload_3')->nullable();
            $table->string('trackings_upload_name_3')->nullable();

            $table->string('trackings_upload_4')->nullable();
            $table->string('trackings_upload_name_4')->nullable();





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
        Schema::dropIfExists('trackings');
    }
}
