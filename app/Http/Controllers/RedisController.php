<?php

namespace App\Http\Controllers;

use App\Student_id;
use App\Dormitory;

class RedisController extends Controller{

    public function first_save(){
        $redis = app('redis.connection');
        $students_detail = Student_id::
            select('id','name','id_card','student_id','class','head_teacher')
            ->orderBy('student_id','asc')
            ->get();
        foreach ($students_detail as $value){
            $json = json_encode($value);
            $redis->set($value->id_card,$json);
            $redis->sadd($value->class,$json);
        }
    }
    public function second_save(){
        $redis = app('redis.connection');
        $students_detail = Dormitory::
        select('id','name','id_card','student_id','location','bed','bed_order','bed_longer')
            ->orderBy('student_id','asc')
            ->get();
        foreach ($students_detail as $value){
            $json = json_encode($value);
            $redis->set($value->student_id,$json);
            $redis->sadd($value->location,$json);
        }
    }
}
/**
 * Created by PhpStorm.
 * User: 20170
 * Date: 2018/7/25
 * Time: 11:01
 */