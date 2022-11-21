<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CellRequest;
use App\Models\Cell;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class CellController extends Controller
{
    public function update(Request $request, JSONcontroller $JSON)
    {
        try {
            $vRack = $request->post('rack');
            $vStorey = $request->post('storey');
            $vRow = $request->post('row');
            $vStorage = $request->post('storage');
            if ($vRack == null || $vStorey == null || $vRow == null || $vStorage == null) {
                return $JSON->JSONerror('Нічого не передали або немає аргументів `rack`,`storey`,`row`, `storage``', 401);
            }
            $vAllCell = DB::table('cell')->where('rack', $vRack)->where('storage_id', $vStorage)->latest('storey')->latest('row')->get();

            foreach ($vAllCell as $cell) {
                if ($cell->storey > $vStorey)
                    Cell::destroy($cell->id);
                if ($cell->row > $vRow)
                    Cell::destroy($cell->id);
            }

            for ($s = 1; $s <= $vStorey; $s++) {
                for ($r = 1; $r <= $vRow; $r++) {
                    if (DB::table('cell')->where('rack', $vRack)->where('storage_id', $vStorage)->where('storey', $s)->where('row', $r)->get()->first() == null) {
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
            return $JSON->JSONsuccessArray('Update', 'New Cells', $cellAll, 201);

        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
    }

    public function destroy(Request $request, JSONcontroller $JSON)
    {
        try {
            $vId = $request->post('id');
            $vRack = $request->post('rack');
            $vStorage = $request->post('storage');

            if ($vId != null) {
                Cell::destroy($vId);
                return $JSON->JSONsuccess('Destroy element by id = ' . $vId, 201);
            } else if ($vRack != null) {
                $vAllCell = Cell::whereRack($request->post('rack'))->whereStorage_id($vStorage);
                $count = $vAllCell->delete();
                return $JSON->JSONsuccess('Destroy array by rack = ' . $vRack . '. delete ' . $count . ' elements.', 201);
            } else {
                return $JSON->JSONerror('Нічого не передали або немає аргументів `id` або `rack`', 401);
            }
        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 400);
        }
    }


    public function index(Request $request, JSONcontroller $JSON)
    {
        try {
            $vRack = $request->get('rack');
            $vId = $request->get('id');
            $vStorage = $request->get('storage');

            if($vId != null)
            {
             $vcell = Cell::whereId($vId)->get();
                return $JSON->JSONsuccessArray('get by id: `' . $vId . '`', 'Cells', $vcell, 200);
            }
            if($vStorage == null){
                return $JSON->JSONerror('`storage` field is missing', 400);
            }
            if($vRack == null){
                return $JSON->JSONsuccessArray('all', 'Cells', Cell::whereStorage_id($vStorage)->get(), 200);
            }else{
                return $JSON->JSONsuccessArray('all', 'Cells', Cell::whereStorage_id($vStorage)->whereRack($vRack)->get(), 200);
            }

        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 400);
        }
    }


    public
    function tranporate(CellRequest $request)
    {
        $c = new Cell();
        return $c->tranporate("f5v");
//        return Cell::create($request->all());
    }


//    public
//    function create(CellRequest $request)
//    {
//        return Cell::create($request->all());
//    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Model|Cell|Cell[]
     */
//    public
//    function update(Cell $cell): Cell|array|Model
//    {
//        dd($cell->get());
//        $service = Cell::find($id);
//        $service->update($request->all());
//        return $service;
//    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return string
     */


//    public
//    function set_cell2(Request $request, JSONcontroller $JSON)
//    {
//        try {
//            try {
//                $request->validate([
//                    'rack' => 'required',
//                    'storey' => 'required',
//                    'row' => 'required'
//                ]);
//            } catch (\Exception) {
//                throw new \Exception('У запиті не знайшло `rack, storey або row`');
//            }
//
////           $gg = DB::select('SELECT * FROM `cell`');
////            dd($gg);
//            $review = new Cell();
//            $review->rack = $request->input('rack');
//            $review->storey = $request->input('storey');
//            $review->row = $request->input('row');
//            $review->save();
//
//            return $JSON->JSONsuccess('Поле успішно додано.', 201);
//
//
//        } catch (\Exception $e) {
//            return $JSON->JSONerror($e->getMessage(), 400);
//        }
//    }
}
