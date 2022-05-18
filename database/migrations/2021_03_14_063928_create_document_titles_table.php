<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_titles', function (Blueprint $table) {
            $table->bigIncrements('document_titles_id');


            $table->bigInteger('users_id')->unsigned()->index()->nullable(); // คนที่สร้างเอกสาร
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');


            $table->bigInteger('users_id_get')->unsigned()->index()->nullable(); // คนทีรับเอกสาร
            $table->foreign('users_id_get')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('districts_id')->unsigned()->index()->nullable(); // อ้างอิงตำบล
            $table->foreign('districts_id')->references('districts_id')->on('districts')->onDelete('cascade');


            $table->bigInteger('faculties_id')->unsigned()->index()->nullable(); // อ้างอิงคณะ
            $table->foreign('faculties_id')->references('faculties_id')->on('faculties')->onDelete('cascade');

            $table->bigInteger('document_patterns_id')->unsigned()->index()->nullable(); //รูปแบบ เอกสาร หรือชื่อเรื่อง
            $table->foreign('document_patterns_id')->references('document_patterns_id')->on('document_patterns')->onDelete('cascade');

            $table->string('document_titles_number_faculties')->nullable(); //เลขที่ คณะ
            $table->string('document_titles_mhesi')->nullable(); //เลขที่ อว
            $table->date('document_titles_mhesi_date')->nullable(); //เลขที่ อว
            $table->string('document_titles_name')->nullable(); //ชื่อเรื่อง

            $table->bigInteger('document_titles_status_within')->default(1);//สถานนะตรวจสอบเอกสารภายใน
            $table->bigInteger('document_titles_status_within_cancel')->nullable();//สถานนะยกเลิก
            $table->bigInteger('document_titles_status')->nullable();//สถานนะการจัดส่งเอกสาร
            $table->bigInteger('document_titles_cancel')->nullable();//สถานนะการจัดส่งเอกสาร ถูกตีกลับ
            $table->date('document_titles_cancel_date')->nullable();//สถานนะการจัดส่งเอกสาร วันที่ ถูกตีกลับ
            $table->date('document_titles_date'); // วันที่



            $table->string('document_titles_upload')->nullable();
            $table->string('document_titles_upload_name')->nullable();



            $table->longText('text_part1')->nullable();  
            $table->longText('text_part2')->nullable(); 
            $table->longText('text_part3')->nullable(); 
            $table->date('date_start_part2')->nullable();   // วันที่เริ่ม
            $table->date('date_end_part2')->nullable();   // วันที่สิ้งสุด

            $table->bigInteger('lecturer_1_part2')->nullable();   // หัวหน้าโครงการ
            // $table->foreign('lecturer_1_part2')->references('districts_id')->on('districts')->onDelete('cascade');
            $table->integer('distance_lecturer_1_part2')->default(0); // จำนวนระยะทาง
            $table->integer('hour_lecturer_1_part2')->default(0);// ชั่วโมงในการอบรม

            $table->bigInteger('lecturer_2_part2')->nullable();   // วิทยากร
            // $table->foreign('lecturer_2_part2')->references('lecturers_id')->on('lecturers')->onDelete('cascade');
            $table->integer('distance_lecturer_2_part2')->default(0);  // จำนวนระยะทาง
            $table->integer('hour_lecturer_2_part2')->default(0);// ชั่วโมงในการอบรม
            
            $table->bigInteger('lecturer_3_part2')->nullable();   // วิทยากร
            // $table->foreign('lecturer_3_part2')->references('lecturers_id')->on('lecturers')->onDelete('cascade');
            $table->integer('hour_lecturer_3_part2')->default(0);// ชั่วโมงในการอบรม

            $table->bigInteger('lecturer_4_part2')->nullable();   // วิทยากร
            // $table->foreign('lecturer_4_part2')->references('lecturers_id')->on('lecturers')->onDelete('cascade');
            $table->integer('hour_lecturer_4_part2')->default(0);// ชั่วโมงในการอบรม

            //กลางวัน
            $table->integer('costs_lunch_meal')->default(0);// จำนวนมื้อ
            $table->integer('costs_lunch_people')->default(0);// คน
            //เที่ยง
            $table->integer('costs_dinner_meal')->default(0);// จำนวนมื้อ
            $table->integer('costs_dinner_people')->default(0);// คน
            //อาหารว่าง
            $table->integer('costs_snack_meal')->default(0);// จำนวนมื้อ
            $table->integer('costs_snack_peopl')->default(0);// คน
            //ส่วนของค่าที่พัก
            $table->integer('costs_accommodation_room')->default(0);// จำนวนห้อง
            $table->integer('costs_accommodation_number')->default(0);// จำนวนคน
            //ส่วนของค่าถ่ายเอกสาร
            $table->integer('costs_paper')->default(0);
            //ส่วนของค่าวัสดุสำนักงาน
            $table->integer('costs_office_material')->default(0);
            //ส่วนของค่าวัสดุสิ้นเปลือง
            $table->integer('costs_consumables')->default(0);
            //ส่วนของค่าค่าเบี้ย เลี้ยง
            $table->integer('costs_allowance')->default(0);
           

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
        Schema::dropIfExists('document_titles');
    }
}
