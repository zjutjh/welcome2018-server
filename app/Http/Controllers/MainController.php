<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class MainController extends Controller{
    public function searchStudentId(Request $request){
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
            return $this->apiReponse(201,'此身份证不存在',null);
        }
    }
}

/**
 * Created by PhpStorm.
 * User: 20170
 * Date: 2018/7/23
 * Time: 15:21
 */