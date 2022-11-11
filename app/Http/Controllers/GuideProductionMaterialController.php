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

    public function decor()
    {
       // dd();
        $decor = new Decor();
        //dd($decor->all());
        return view('decor', $decor->all());
    }
}
