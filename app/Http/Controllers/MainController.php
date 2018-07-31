<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class MainController extends Controller{
    public function searchStudentId(Request $request){
        if(!$request){
            return $this->apiReponse(201,'未接收到数据',null);
        }
        $redis = app('redis.connection');
        $name = $request->get('name');
        $id_card = $request->get('pass');
        if($student = $redis->get($id_card)){
            $student = json_decode($student);
            if ($student->name == $name){
                if ($qq_groups = $redis->smembers($student->hometown)){
                    return $this->apiReponse(200,null,['student'=>$student,'qq_groups'=>$qq_groups]);
                }
                elseif ($student->hometown == '浙江省'){
                    return $this->apiReponse(200,null,['student'=>$student,'qq_groups'=>$this->getZheJiangQqGroups($student)]);
                }
                else{
                    return $this->apiReponse(200,null,['student'=>$student,'qq_groups'=>$qq_groups]);
                }

            }
            else{
                return $this->apiReponse(201,'身份证与姓名不匹配',null);
            }
        }
        else{
            return $this->apiReponse(201,'查无此人',null);
        }
    }

    public function getClassmates(Request $request){
        if(!$request){
            return $this->apiReponse(201,'未接收到数据',null);
        }
        $redis = app('redis.connection');
        $id_card = $request->get('id_card');
        if ($student = $redis->get($id_card)){
            $student = json_decode($student);
            $class = $student->class;
        }
        else{
            return $this->apiReponse(201,'查无此人',null);
        }
        $classmates = $redis->smembers($class);
        return $this->apiReponse(200,null,['classmates'=>$classmates]);
    }

    public function searchDormitory(Request $request){
        if(!$request){
            return $this->apiReponse(201,'未接收到数据',null);
        }
        $redis = app('redis.connection');
        $name = $request->get('name');
        $id_card = $request->get('pass');
        if($student = $redis->get($id_card)){
            $student = json_decode($student);
            if ($student->name == $name){
                $student_id = $student->student_id;
            }
            else{
                return $this->apiReponse(201,'身份证与姓名不匹配',null);
            }
        }
        else{
            return $this->apiReponse(201,'查无此人',null);
        }
        if ($dormitory = $redis->get($student_id)){
            $dormitory = json_decode($dormitory);
            return $this->apiReponse(200,null,$dormitory);
        }
        else{
            return $this->apiReponse(201,'未查到寝室信息',null);
        }
    }

    public function getRoommates(Request $request){
        if(!$request){
            return $this->apiReponse(201,'未接收到数据',null);
        }
        $redis = app('redis.connection');
        $student_id = $request->get('student_id');
        if ($dormitory = $redis->get($student_id)){
            $dormitory = json_decode($dormitory);
            $location = $dormitory->location;
        }
        else{
            return $this->apiReponse(201,'查无此人',null);
        }
        $roommates = $redis->smembers($location);
        return $this->apiReponse(200,null,['roommates'=>$roommates]);
    }

    public function getZheJiangQqGroups($student){
        $redis = app('redis.connection');
        $beginning = substr($student->id_card,0,6);
        if (substr($beginning,0,4) == '3302'){
            return $redis->smembers('宁波市');
        }
        elseif (substr($beginning,0,4) == '3302'){
            return $redis->smembers('温州市');
        }
        elseif (substr($beginning,0,4) == '3304'){
            return $redis->smembers('嘉兴市');
        }
        elseif (substr($beginning,0,4) == '3305'){
            return $redis->smembers('湖州市');
        }
        elseif (substr($beginning,0,4) == '3306'){
            return $redis->smembers('绍兴市');
        }
        elseif (substr($beginning,0,4) == '3325'){
            return $redis->smembers('丽水地区');
        }
        elseif (substr($beginning,0,4) == '3307'){
            if ($beginning == '330781'){
                return $redis->smembers('兰溪市','金华市');
            }
            else{
                return $redis->smembers('金华市');
            }
        }
        elseif (substr($beginning,0,4) == '3310'){
            if ($beginning == '331023'){
                return $redis->smembers('天台县','台州市');
            }
            else{
                return $redis->smembers('台州市');
            }
        }
        else{
            return null;
        }
    }
}

/**
 * Created by PhpStorm.
 * User: 20170
 * Date: 2018/7/23
 * Time: 15:21
 */