<?php

namespace App\Http\Controllers;

use http\Env\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function get_URL_variable($request, $name_var, $size_part)
    {

        for ($i = 1; $i <= $size_part; $i++) {
            $part = explode("=", $request->route('part_' . $i));
            if ($part[0] == $name_var) {
                return $part[1];
            }
        }

    }

    protected function get_URL_variable2(Request $request, $name_var, $size_part)
    {

        //dd($request->all());
        for ($i = 1; $i <= $size_part; $i++) {
            $part = explode("=", $request->route('part_' . $i));
            if ($part[0] == $name_var) {
                return $part[1];
            }
        }

    }


}
