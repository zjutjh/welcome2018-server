<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDormitoryTable extends Migration{
    public function up(){
        Schema::create('dormitory', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('姓名');
            $table->char('id_card',18)->comment('身份证号');
            $table->string('location')->comment('寝室位置');
            $table->tinyInteger('bed_order')->comment('是否预定床上用品，0为预定，1为未预定');
            $table->tinyInteger('bed_longer')->comment('床是否加长，0为不加长，1为加长');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('dormitory');
    }
}
/**
 * Created by PhpStorm.
 * User: 20170
 * Date: 2018/7/24
 * Time: 21:53
 */