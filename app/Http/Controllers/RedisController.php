<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class RedisController extends Controller{

    public function save(){
        $redis = app('redis.connection');
        $students_detail = DB::table('student_id')
            ->select('id','name','id_card','student_id','class','head_teacher')
            ->orderBy('student_id','asc')
            ->get();
        foreach ($students_detail as $value){
            $json = json_encode($value);
            $redis->set($value->id_card,$json);
            $redis->sadd($value->class,$json);
        }
    }
}
/**
 * Created by PhpStorm.
 * User: 20170
 * Date: 2018/7/25
 * Time: 11:01
 */