<?php

namespace App\Http\Controllers\Web\Decor;

use App\Http\Controllers\Api\JSONcontroller;
use App\Http\Controllers\Controller;
use App\Models\Cell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebCellController extends Controller
{
    public function dd(){
        dd(1);
    }
    public function CellGet(Request $request)
    {
        try {
            if ($vId = $request->get('id') != null) {
                $vCall = DB::table('cell')->where('id', $vId)->get();
                return view('cell', ['cell'=> $vCall, 'rack'=>$request->rack]);
               // return JSONcontroller::JSONsuccessArray('get by id: `' . $vId . '`', 'Cells', $vCall, 200);
            } else if (($vRack = $request->get('rack')) != null) {
                $vCall = DB::table('cell')->where('rack', $vRack)->get();
                return view('cell', ['cell'=> $vCall, 'rack'=>$request->rack]);
               // return JSONcontroller::JSONsuccessArray('get by rack: `' . $vRack . '`', 'Cells', $vCall, 200);
            } else {
                return view('cell', ['cell'=> Cell::all(), 'rack'=>$request->rack]);
            }
        } catch (\Exception $e) {
            return JSONcontroller::JSONerror($e->getMessage(), 400);
        }
    }
}
