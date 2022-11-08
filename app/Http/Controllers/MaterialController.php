<?php

namespace App\Http\Controllers;

use App\Models\MaterialModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    public function MaterialGet(Request $request, JSONcontroller $JSON)
    {
        dd(MaterialModel::all());

    }
}
