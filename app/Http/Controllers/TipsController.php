<?php

namespace App\Http\Controllers;

use App\Tip;

class TipsController extends Controller
{
    public function showTips()
    {
        $tips = Tip::get();
        $index = random_int(0, count($tips) - 1);
        return $this->apiReponse(1, null, ['tip' => $tips[$index]]);
    }
}

/**
 * Created by PhpStorm.
 * User: 20170
 * Date: 2018/8/4
 * Time: 20:49
 */