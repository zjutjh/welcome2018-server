<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;


class MainController extends Controller
{
    public function searchStudentId(Request $request)
    {
        $name = $request->input('name');
        $id_card = $request->input('id');
        if (!$name  || !$id_card) {
            return $this->apiReponse(-1, '未接收到数据', null);
        }
        $redis = app('redis.connection');
        if ($student = $redis->get($id_card)) {
            $student = json_decode($student);
            if ($student->name == $name) {
                return $this->apiReponse(1, null, ['student' => $student]);
            } else {
                return $this->apiReponse(-1, '身份证与姓名不匹配', null);
            }
        } else {
            return $this->apiReponse(-1, '查无此人', null);
        }
    }

    public function searchStudentDetail(Request $request)
    {
        if (!$stdcode = $request->input('stdcode')) {
            return $this->apiReponse(-1, '未绑定精小弘，请先绑定精小弘', null);
        }
        $redis = app('redis.connection');
        $client = new Client();
        $req = $client->request('POST', 'http://jxh.jh.zjut.edu.cn/stdcode/to/sid', [
            'form_params' => [
                'stdcode' => $stdcode
            ]
        ]);
        $code = json_decode((string)$req->getBody())->code;
        if ($code < 0) {
            return $this->apiReponse(-1, 'code已过期', null);
        }
        $student_id = json_decode((string)$req->getBody())->data->sid;
        if (null === $redis->get($student_id)) {
            return $this->apiReponse(-1, '查无此人', null);
        }
        $id_card = json_decode($redis->get($student_id))->id_card;
        if ($student = $redis->get($id_card)) {
            $student = json_decode($student);
            if ($qq_groups = $redis->smembers($student->hometown)) {
                return $this->apiReponse(1, null, ['student' => $student, 'qq_groups' => $this->change($qq_groups)]);
            } elseif ($student->hometown == '浙江省') {
                return $this->apiReponse(1, null, ['student' => $student, 'qq_groups' => $this->change($this->getZheJiangQqGroups($student))]);
            } else {
                return $this->apiReponse(1, null, ['student' => $student, 'qq_groups' => $this->change($qq_groups)]);
            }
        } else {
            return $this->apiReponse(-1, '查无此人', null);
        }
    }

    public function getClassmates(Request $request)
    {
        if (!$id_card = $request->input('id_card')) {
            return $this->apiReponse(-1, '未接收到数据', null);
        }
        $redis = app('redis.connection');
        if ($student = $redis->get($id_card)) {
            $student = json_decode($student);
            $class = $student->class;
        } else {
            return $this->apiReponse(-1, '查无此人', null);
        }
        $classmates = $redis->smembers($class);
        return $this->apiReponse(1, null, ['classmates' => $this->change($classmates)]);
    }

    public function searchDormitory(Request $request)
    {
        $name = $request->input('name');
        $id_card = $request->input('pass');
        if (!$name || !$id_card) {
            return $this->apiReponse(-1, '未接收到数据', null);
        }
        $redis = app('redis.connection');

        if ($student = $redis->get($id_card)) {
            $student = json_decode($student);
            if ($student->name == $name) {
                $student_id = $student->student_id;
            } else {
                return $this->apiReponse(-1, '身份证与姓名不匹配', null);
            }
        } else {
            return $this->apiReponse(-1, '查无此人', null);
        }
        if ($dormitory = $redis->get($student_id)) {
            $dormitory = json_decode($dormitory);
            return $this->apiReponse(1, null, $dormitory);
        } else {
            return $this->apiReponse(-1, '未查到寝室信息', null);
        }
    }

    public function getRoommates(Request $request)
    {
        if (!$student_id = $request->input('student_id')) {
            return $this->apiReponse(-1, '未接收到数据', null);
        }
        $redis = app('redis.connection');
        if ($dormitory = $redis->get($student_id)) {
            $dormitory = json_decode($dormitory);
            $location = $dormitory->location;
        } else {
            return $this->apiReponse(-1, '查无此人', null);
        }
        $roommates = $redis->smembers($location);
        return $this->apiReponse(1, null, ['roommates' => $roommates]);
    }

    public function change($list)
    {
        $newlist = [];
        $index = 0;
        foreach ($list as $value) {
            $newlist[$index] = json_decode($value);
            $index++;
        }
        return $newlist;
    }

    public function getZheJiangQqGroups($student)
    {
        $redis = app('redis.connection');
        $beginning = substr($student->id_card, 0, 6);
        if (substr($beginning, 0, 4) == '3302') {
            return $redis->smembers('宁波市');
        } elseif (substr($beginning, 0, 4) == '3302') {
            return $redis->smembers('温州市');
        } elseif (substr($beginning, 0, 4) == '3304') {
            return $redis->smembers('嘉兴市');
        } elseif (substr($beginning, 0, 4) == '3305') {
            return $redis->smembers('湖州市');
        } elseif (substr($beginning, 0, 4) == '3306') {
            return $redis->smembers('绍兴市');
        } elseif (substr($beginning, 0, 4) == '3325') {
            return $redis->smembers('丽水地区');
        } elseif (substr($beginning, 0, 4) == '3307') {
            if ($beginning == '330781') {
                return $redis->smembers('兰溪市', '金华市');
            } else {
                return $redis->smembers('金华市');
            }
        } elseif (substr($beginning, 0, 4) == '3310') {
            if ($beginning == '331023') {
                return $redis->smembers('天台县', '台州市');
            } else {
                return $redis->smembers('台州市');
            }
        } else {
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