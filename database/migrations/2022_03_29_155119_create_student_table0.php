<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable0 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_', function (Blueprint $table) {
            $table->id('id_student');
            $table->String('nim', 10)->index();
            $table->String('name', 25)->index();
            $table->String('class', 5);
            $table->String('major', 35);
            $table->String('Address', 50);
            $table->date('Date_of_Birth');
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
        Schema::dropIfExists('student_');
    }
}
