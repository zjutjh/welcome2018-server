<?php

namespace App\Http\Controllers;

use App\Tip;

class TipsController extends Controller
{
    public function showTips()
    {
        $tips = Tip::get();
        $index = random_int(1, count($tips));
        return $this->apiReponse(200, null, ['tip' => $tips[$index]]);
    }
}

/**
 * Created by PhpStorm.
 * User: 20170
 * Date: 2018/8/4
 * Time: 20:49
 */