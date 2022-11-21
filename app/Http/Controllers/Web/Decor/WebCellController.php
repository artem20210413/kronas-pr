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

    public function cellGet($vStorage ,Request $request, JSONcontroller $JSON)
    {
        try {
            $vRack = $request->get('rack');
            $vId = $request->get('id');
//            $vStorage = $request->get('storage');

            if ($vId != null) {
                $vCall = Cell::whereId($vId)->get();
            }
            if ($vStorage == null) {
                return $JSON->JSONerror('`storage` field is missing', 400);
            }
            if ($vRack == null) {
                $vCall = Cell::whereStorage_id($vStorage)->get();
            } else {
                $vCall = Cell::whereStorage_id($vStorage)->whereRack($vRack)->get();
            }
            return view('cell', ['cell' => $vCall, 'rack' => $vRack, 'allRack' => Cell::distinct()->whereStorage_id($vStorage)->get('rack'), 'storage_id' => $vStorage]);
        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 400);
        }
    }

//    public function CellGet(Request $request)
//    {
//        try {
//            if ($vId = $request->get('id') != null) {
//                $vCall = DB::table('cell')->where('id', $vId)->get();
//            } else if (($vRack = $request->get('rack')) != null || $request->get('rack') != "") {
//                $vCall = DB::table('cell')->where('rack', $vRack)->get();
//            } else {
//                $vCall = Cell::all();
//            }
//            return view('cell', ['cell' => $vCall, 'rack' => $request->rack, 'allRack' => Cell::distinct()->get('rack')]);
//        } catch (\Exception $e) {
//            return (new JSONcontroller)->JSONerror($e->getMessage(), 400);
//        }
//    }


    public function CellUpdate($vStorage, Request $request)
    {
        try {
            $vRack = $request->post('rack');
            $vStorey = $request->post('storey');
            $vRow = $request->post('row');
            if ($vRack == null || $vStorey == null || $vStorey <= 0 || $vRow == null || $vRow <= 0) {
                return (new JSONcontroller)->JSONerror('Нічого не передали або значення від`ємне', 401); //немає аргументів `rack`,`storey`,`row`
            }
            $vAllCell = DB::table('cell')->where('rack', $vRack)->where('storage_id',$vStorage)->latest('storey')->latest('row')->get();
            foreach ($vAllCell as $cell) {
                if ($cell->storey > $vStorey)
                    Cell::destroy($cell->id);
                if ($cell->row > $vRow)
                    Cell::destroy($cell->id);
            }
            for ($s = 1; $s <= $vStorey; $s++) {
                for ($r = 1; $r <= $vRow; $r++) {
                    if (DB::table('cell')->where('rack', $vRack)->where('storage_id',$vStorage)->where('storey', $s)->where('row', $r)->get()->first() == null) {
                        $cell = new Cell();
                        $cell->rack = $vRack;
                        $cell->storey = $s;
                        $cell->row = $r;
                        $cell->storage_id = $vStorage;
                        $cell->save();
                    }
                }
            }
            $cellAll = DB::table('cell')->where('rack', $vRack)->where('storage_id',$vStorage)->latest('storey')->latest('row')->get();
            return ['cell' => $cellAll, 'rack' => $vRack, 'storage_id' => $vStorage];
            // return view('cell', ['cell' => $cellAll, 'rack' => $vRack]);
            // return JSONcontroller::JSONsuccessArray('Update', 'New Cells', $cellAll, 201);
        } catch (\Exception $e) {
            return (new JSONcontroller)->JSONerror($e->getMessage(), 501);
        }
    }

    public function CellDestroy($vStorage, Request $request)
    {
//        $vRack = $request->post('rack');
//        $r = Cell::whereRack($vRack);
//        $res = $r->delete();
//        dd($res);
//        dd($r->count());
        try {
//            $vId = $request->get('id');
//            $vRack = $request->get('rack');
            $vId = $request->post('id');
            $vRack = $request->post('rack');
//            $cell = new Cell();
            if ($vId != null) {
                Cell::destroy($vId);
                return (new JSONcontroller)->SONsuccess('Destroy element by id = ' . $vId, 201);
            } else if ($vRack != null) {

                $vAllCell = Cell::whereRack($vRack)->whereStorage_id($vStorage);
                $count = $vAllCell->delete();
                return (new JSONcontroller)->JSONsuccess('Destroy array by rack = ' . $vRack . '. delete ' . $count . ' elements.', 201);
            } else {
                return (new JSONcontroller)->JSONerror('Нічого не передали або немає аргументів `id` або `rack`', 401);
            }
        } catch (\Exception $e) {
            return (new JSONcontroller)->JSONerror($e->getMessage(), 400);
        }
    }
}
