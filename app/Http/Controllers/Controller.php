<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function apiReponse($code,$error,$data)
    {
        $json = [
            'code' => $code,
            'error' => $error,
            'data' => $data
        ];

        return response()->json($json);
    }
}
