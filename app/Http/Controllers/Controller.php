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
//        dd($request->getHeader('Authorization'));
//        $res = Http::withHeaders([
//            'Content-Type' => 'application/json',
//            'Accept' => 'application/json',
//            'Authorization' => $request->getHeader('Authorization'),
//
//        ])->post('https://auth.kronas.com.ua/api/v1/my/roles');
//        if ($res->status() == 200)
//            dd(true);
//        else dd(false);
//    }
    public function __construct(Request $request)
    {
            $res = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => $request->header('Authorization'),

            ])->post('https://auth.kronas.com.ua/api/v1/my/roles');
            if ($res->status() == 200) {

                //dd(true);
                return true;
            } else {
                echo response()->json([
                    "code" => 401,
                    'status' => 'Fail',
                    'type' => 'error',
                    'message' => 'unauthorized'
                ], 401);
                exit();

            }


    }

    protected function validToken($request)
    {

        //dd($request->header('Authorization'));
        $res = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => $request->header('Authorization'),

        ])->post('https://auth.kronas.com.ua/api/v1/my/roles');
        if ($res->status() == 200) {
            return true;
        } else {
            // dd(false);
            //exit();
            return false;//(new JSONcontroller())->JSONerror("unauthorized", 401);
        }

    }

    protected function get_URL_variable($request, $name_var, $size_part)
    {

        for ($i = 1; $i <= $size_part; $i++) {
            $part = explode("=", $request->route('part_' . $i));
            if ($part[0] == $name_var) {
                return $part[1];
            }
        }

    }


}
