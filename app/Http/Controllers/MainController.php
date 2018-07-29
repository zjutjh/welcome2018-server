<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class MainController extends Controller{
    public function searchStudentId(Request $request){
        if($request){
            return $this->apiReponse(201,'未接收到数据',null);
        }
        $redis = app('redis.connection');
        $name = $request->get('name');
        $id_card = $request->get('pass');
        if($student = $redis->get($id_card)){
            $student = json_decode($student);
            if ($student->name == $name){
                return $this->apiReponse(200,null,$student);
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
        if($request){
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
        if($request){
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
        if($request){
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
}

/**
 * Created by PhpStorm.
 * User: 20170
 * Date: 2018/7/23
 * Time: 15:21
 */