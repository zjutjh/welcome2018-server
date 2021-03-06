<?php

namespace App\Http\Controllers;

use App\Student_id;
use App\Dormitory;
use App\Qq_group;

class RedisController extends Controller
{

    public function first_save()
    {
        $redis = app('redis.connection');
        $students_detail = Student_id::
        select('id', 'name', 'id_card', 'hometown', 'student_id', 'class', 'head_teacher')
            ->orderBy('student_id', 'asc')
            ->get();
        foreach ($students_detail as $value) {
            $json = json_encode($value);
            $redis->set($value->id_card, $json);
            $redis->set($value->student_id, $json);
            $redis->sadd($value->class, $json);
        }
        $qq_groups = Qq_group::
        select('hometown', 'qq_group', 'name')
            ->get();
        foreach ($qq_groups as $value) {
            $json = json_encode($value);
            $redis->sadd($value->hometown, $json);
        }
    }

    public function second_save()
    {
        $redis = app('redis.connection');
        $dormitory_detail = Dormitory::
        select('id', 'name', 'class', 'student_id', 'location', 'number', 'bed', 'bed_order')
            ->orderBy('student_id', 'asc')
            ->get();
        foreach ($dormitory_detail as $value) {
            $json = json_encode($value);
            var_dump($json);
            $redis->set($value->student_id, $json);
            $redis->sadd($value->number, $json);
        }
    }
}
/**
 * Created by PhpStorm.
 * User: 20170
 * Date: 2018/7/25
 * Time: 11:01
 */