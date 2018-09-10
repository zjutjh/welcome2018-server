<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDormitoriesTable extends Migration{
    public function up(){
        Schema::create('dormitories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('姓名');
            $table->char('class',20)->comment('班级');
            $table->char('student_id',12)->comment('学号');
            $table->string('location')->comment('楼号');
            $table->string('number')->comment('寝室号');
            $table->integer('bed')->comment('床号');
            $table->integer('bed_order')->comment('是否预定床上用品 0为否 1为是');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('dormitories');
    }
}
/**
 * Created by PhpStorm.
 * User: 20170
 * Date: 2018/7/24
 * Time: 21:53
 */