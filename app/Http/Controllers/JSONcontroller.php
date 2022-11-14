<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JSONcontroller extends Controller
{
    /* Вывод JSON ошибки сообщение / статус*/
    public function JSONerror($message, $status){
        return response()->json([
            "code" => $status,
            'status' => 'Fail',
            'type' => 'error',
            'message' => $message
        ], $status); // 200
    }
    public function JSONsuccess($message, $status){
        return response()->json([
            "code" => $status,
            'status' => 'success',
            'message' => [
                'status' => $message
            ],
        ],$status);
    }
    public function JSONsuccessArray($message, $name_array, $array, $status)
    {
        return response()->json([
            "code" => $status,
            'status' => 'success',
            'message' => $message,
            $name_array => $array
        ],$status);
    }
}
