<?php

namespace App\Http\Controllers\Web\Decor;


use App\Http\Controllers\Api\JSONcontroller;
use App\Http\Controllers\Controller;
use App\Models\Cell;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebCellController extends Controller
{
    public function ViewCellUpdate(Request $request)
    {


        return view('cell_CU', ['create' => $request->get('create')]);
    }

    public function CellGet(Request $request)
    {
        try {
            if ($vId = $request->get('id') != null) {
                $vCall = DB::table('cell')->where('id', $vId)->get();
                return view('cell', ['cell' => $vCall, 'rack' => $request->rack]);
                // return JSONcontroller::JSONsuccessArray('get by id: `' . $vId . '`', 'Cells', $vCall, 200);
            } else if (($vRack = $request->get('rack')) != null || $vRack != " ") {
                $vCall = DB::table('cell')->where('rack', $vRack)->get();
                return view('cell', ['cell' => $vCall, 'rack' => $request->rack]);
                // return JSONcontroller::JSONsuccessArray('get by rack: `' . $vRack . '`', 'Cells', $vCall, 200);
            } else {
                //return $vRack;
                return view('cell', ['cell' => Cell::all(), 'rack' => $request->rack]);
                //return ['cell' => Cell::all(), 'rack' => $request->rack];
            }
        } catch (\Exception $e) {
            return (new JSONcontroller)->JSONerror($e->getMessage(), 400);
        }
    }
    public function CellUpdate(Request $request)
    {
        try {
            $vRack = $request->post('rack');
            $vStorey = $request->post('storey');
            $vRow = $request->post('row');
            if ($vRack == null || $vStorey == null || $vRow == null) {
                return (new JSONcontroller)->JSONerror('Нічого не передали або немає аргументів `rack`,`storey`,`row`', 401);
            }
            $vAllCell = DB::table('cell')->where('rack', $vRack)->latest('storey')->latest('row')->get();
            foreach ($vAllCell as $cell) {
                if ($cell->storey > $vStorey)
                    Cell::destroy($cell->id);
                if ($cell->row > $vRow)
                    Cell::destroy($cell->id);
            }
            for ($s = 1; $s <= $vStorey; $s++) {
                for ($r = 1; $r <= $vRow; $r++) {
                    if (DB::table('cell')->where('rack', $vRack)->where('storey', $s)->where('row', $r)->get()->first() == null) {
                        $cell = new Cell();
                        $cell->rack = $vRack;
                        $cell->storey = $s;
                        $cell->row = $r;
                        $cell->save();
                    }
                }
            }
            $cellAll = DB::table('cell')->where('rack', $vRack)->latest('storey')->latest('row')->get();
           return view('cell',['cell'=>$cellAll, 'rack'=> $vRack]);
            // return JSONcontroller::JSONsuccessArray('Update', 'New Cells', $cellAll, 201);
        } catch (\Exception $e) {
            return (new JSONcontroller)->JSONerror($e->getMessage(), 501);
        }
    }

}
