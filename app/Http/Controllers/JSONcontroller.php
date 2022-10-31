<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JSONcontroller extends Controller
{
    /* Вывод JSON ошибки сообщение / статус*/
    public function JSONerror($message, $status){
        return response()->json([
            'success' => false,
            'error' => [
                'message' => $message
            ]
        ], $status);
    }
    public function JSONsuccess($message, $status){
        return response()->json([
            'success' => true,
            'message' => [
                'status' => $message
            ]
        ],$status);
    }
}
