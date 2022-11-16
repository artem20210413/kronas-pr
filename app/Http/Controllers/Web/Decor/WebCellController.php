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

    public function GetCellRackAll()
    {
        return Cell::distinct()->get('rack');
    }

    public function CellGet(Request $request)
    {
        try {
            if ($vId = $request->get('id') != null) {
                $vCall = DB::table('cell')->where('id', $vId)->get();
            } else if (($vRack = $request->get('rack')) != null || $request->get('rack') != "") {
                $vCall = DB::table('cell')->where('rack', $vRack)->get();
            } else {
                $vCall = Cell::all();
            }
            return view('cell', ['cell' => $vCall, 'rack' => $request->rack, 'allRack' => Cell::distinct()->get('rack')]);
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
            if ($vRack == null || $vStorey == null || $vStorey <=0 || $vRow == null || $vRow <=0) {
                return (new JSONcontroller)->JSONerror('Нічого не передали або значення від`ємне', 401); //немає аргументів `rack`,`storey`,`row`
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
            return ['cell' => $cellAll, 'rack' => $vRack];
            // return view('cell', ['cell' => $cellAll, 'rack' => $vRack]);
            // return JSONcontroller::JSONsuccessArray('Update', 'New Cells', $cellAll, 201);
        } catch (\Exception $e) {
            return (new JSONcontroller)->JSONerror($e->getMessage(), 501);
        }
    }

}
