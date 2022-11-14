<?php

namespace App\Http\Controllers;

use App\Models\Decor;
use Illuminate\Http\Request;

class GuideProductionMaterialController extends Controller
{
    public function production_material()
    {
        return view('production_material');
    }

    public function decor(Request $request,JSONcontroller $JSON, DecorController $decor)
    {
        //$decor->DecorGet();
        $decor = new Decor();
        //dd($decor->all());
        //dd($decor->DecorGet($request, $JSON);
        return view('decor', ['data' => Decor::all()]);
    }
}
