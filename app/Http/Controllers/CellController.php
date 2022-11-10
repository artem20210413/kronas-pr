<?php

namespace App\Http\Controllers;

use App\Http\Requests\CellDeleteRequest;
use App\Http\Requests\CellRequest;
use App\Models\Cell;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class CellController extends Controller
{
    public function CellUpdate(Request $request, JSONcontroller $JSON)
    {

        try {
//            $vId = $request->get('id');
//            $vRack = $request->get('rack');
//            $vStorey = $request->get('storey');
//            $vRow = $request->get('row');
            //$vId = $request->post('id');
            $vRack = $request->post('rack');
            $vStorey = $request->post('storey');
            $vRow = $request->post('row');
            if ($vRack == null || $vStorey == null || $vRow == null) {
                return $JSON->JSONerror('Нічого не передали або немає аргументів `rack`,`storey`,`row`', 401);
            }
//            $vLastCell = DB::table('cell')->where('rack', $vRack)->latest('storey')->latest('row')->first();
//            $vLastStorey = $vLastCell->storey;
//            $vLastRow = $vLastCell->row;

//            $vAllCell = DB::table('cell')->where('rack',$vRack)->latest('storey')->latest('row')->get();
            $vAllCell = DB::table('cell')->where('rack', $vRack)->latest('storey')->latest('row')->get();
            foreach ($vAllCell as $cell) {
                if ($cell->storey > $vStorey)
                    Cell::destroy($cell->id);
                if ($cell->row > $vRow)
                    Cell::destroy($cell->id);
                //dd($cell);
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
            $cellAll=DB::table('cell')->where('rack', $vRack)->latest('storey')->latest('row')->get();
            return $JSON->JSONsuccessArray('Update', 'New Cells', $cellAll, 201);

        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
//        try {
//            $cell = new Cell();
//            $cell->rack = $request->input('rack');
//            $cell->storey = $request->input('storey');
//            $cell->row = $request->input('row');
//            $cell->save();
//            //$cell->transform_cell($request);
//            return $JSON->JSONsuccess("Успіх", 201);
//
//        } catch (\Exception $e) {
//            return $JSON->JSONerror($e->getMessage(), 401);
//        }


    }

    public function CellDestroy(Request $request, JSONcontroller $JSON)
    {

        try {
//            $vId = $request->get('id');
//            $vRack = $request->get('rack');
            $vId = $request->post('id');
            $vRack = $request->post('rack');
//            $cell = new Cell();

            if ($vId != null) {
                Cell::destroy($vId);
                return $JSON->JSONsuccess('Destroy element by id = ' . $vId, 201);
            } else if ($vRack != null) {
                $vAllCell = DB::table('cell')->where('rack', $vRack)->get();
                $count = 0;
                foreach ($vAllCell as $cell) {
                    Cell::destroy($cell->id);
                    $count++;
                }
                return $JSON->JSONsuccess('Destroy array by rack = ' . $vRack . '. delete ' . $count . ' elements.', 201);
            } else {
                return $JSON->JSONerror('Нічого не передали або немає аргументів `id` або `rack`', 401);
            }
//            try {
//                $request->validate([
//                    'rack' => 'required',
//                    'storey' => 'required',
//                    'row' => 'required'
//                ]);
//            } catch (\Exception) {
//                throw new \Exception('У запиті не знайшло `rack, storey або row`');
//            }
//            /*видаляємо масив елементів*/
//            $res = Cell::destroy($request->get('ids'));
//            return $JSON->JSONsuccess('Cells deleted!' . $res . ' el', 200);
        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 400);
        }
    }
    public function CellId(Cell $cell_id)
    {
        dd($cell_id);
    }

    public function CellGet(Request $request, JSONcontroller $JSON)
    {
        try {
            $vId = $request->get('id');
            $vRack = $request->get('rack');
            if ($vId != null) {
                $vCall = DB::table('cell')->where('id', $vId)->get();
                return $JSON->JSONsuccessArray('get by id: `' . $vId . '`', 'Cells', $vCall, 401);
            } else if ($vRack != null) {
                $vCall = DB::table('cell')->where('rack', $vRack)->get();
                return $JSON->JSONsuccessArray('get by rack: `' . $vRack . '`', 'Cells', $vCall, 401);
                ////return $JSON->JSONsuccess('Destroy array by rack = '. $vRack. '. delete ' . $count .' elements.', 201);
            } else {
                return $JSON->JSONsuccessArray('all', 'Cells', Cell::all(), 401);
            }
//            $Cell = new Cell();
//            try {
//                $request->validate([
//                    'rack' => 'required'
//                ]);
//            } catch (\Exception) {
//                return $JSON->JSONsuccessArray('Get  all', 'Cell', $Cell::all(), 200);
//            }
//
//            /*виводимо з бази по фільтру*/
//            return $JSON->JSONsuccessArray(
//                'Get rack by `' . $request->input('rack') . '`',
//                'Cell',
//                $Cell::where('rack', $request->input('rack'))->get(),
//                200);

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

    public
    function testURL(Request $request)
    {
        // Get the current URL without the query string...
        //echo url()->current();
        // Get the current URL including the query string...
        //echo url()->full();

        dd(URL::current());

    }

    public
    function create(CellRequest $request)
    {
        return Cell::create($request->all());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Model|Cell|Cell[]
     */
    public
    function update(Cell $cell): Cell|array|Model
    {
        dd($cell->get());
//        $service = Cell::find($id);
        $service->update($request->all());
        return $service;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return string
     */


    public
    function set_cell2(Request $request, JSONcontroller $JSON)
    {
        try {
            try {
                $request->validate([
                    'rack' => 'required',
                    'storey' => 'required',
                    'row' => 'required'
                ]);
            } catch (\Exception) {
                throw new \Exception('У запиті не знайшло `rack, storey або row`');
            }

//           $gg = DB::select('SELECT * FROM `cell`');
//            dd($gg);
            $review = new Cell();
            $review->rack = $request->input('rack');
            $review->storey = $request->input('storey');
            $review->row = $request->input('row');
            $review->save();

            return $JSON->JSONsuccess('Поле успішно додано.', 201);


        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 400);
        }
    }
}
