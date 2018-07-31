<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentIdsTable extends Migration{
    public function up(){
        Schema::create('student_ids', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('姓名');
            $table->char('id_card',18)->comment('身份证号');
            $table->string('hometown')->comment('生源地');
            $table->char('student_id',12)->comment('学号');
            $table->string('class')->comment('班级');
            $table->string('head_teacher')->comment('班主任');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('student_ids');
    }
}



/**
 * Created by PhpStorm.
 * User: 20170
 * Date: 2018/7/24
 * Time: 21:41
 */