<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculties', function (Blueprint $table) {
            $table->bigIncrements('faculties_id');
            $table->string('faculties_name')->unique(); // ชื่อตำบล
            $table->string('faculties_number')->nullable();  // เลขคณะ
            $table->date('faculties_date')->nullable();  // เลขคณะ
            $table->string('faculties_tel')->nullable();  // เบอร์โทร
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
        Schema::dropIfExists('faculties');
    }
}
