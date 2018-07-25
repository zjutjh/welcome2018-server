<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class RedisController extends Controller{

    public function save(){
        $redis = app('redis.connection');
        $students_detail = DB::table('student_id')
            ->select('id','name','id_card','student_id','class','head_teacher')
            ->get();
        foreach ($students_detail as $value){
            $redis->set($value->id_card,json_encode($value));
        }
        var_dump($redis->get("34012319980720715X"));
        var_dump($redis->get("342426199903150621"));
    }
}
/**
 * Created by PhpStorm.
 * User: 20170
 * Date: 2018/7/25
 * Time: 11:01
 */