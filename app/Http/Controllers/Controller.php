<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\JSONcontroller;

//use http\Env\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Exception;
use Psy\Util\Json;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

//    public function __construct(Request $request)
//    {
//        //dd($request->header('Authorization'));
//        $res = Http::withHeaders([
//            'Content-Type' => 'application/json',
//            'Accept' => 'application/json',
//            'Authorization' => $request->header('Authorization'),
//
//        ])->post('https://auth.kronas.com.ua/api/v1/my/roles');
//       // dd($res->body());
//        if ($res->status() == 200) {
//            return true;
//        } else {
//            echo response()->json([
//                "code" => 401,
//                'status' => 'Fail',
//                'type' => 'error',
//                'message' => 'unauthorized'
//            ], 401);
//            exit();
//        }
//    }
}
