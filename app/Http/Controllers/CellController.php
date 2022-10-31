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


class CellController extends Controller
{
    public function tranporate(CellRequest $request)
    {
        $c = new Cell();
        return $c->tranporate("f5v");
//        return Cell::create($request->all());
    }

    public function create(CellRequest $request)
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
    public function update(Cell $cell): Cell|array|Model
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
    public function destroy(Request $request): string
    {

        /*видаляємо масив елементів*/
        $res = Cell::destroy($request->get('ids'));
        return ('Cells deleted!' . $res . ' el');
    }


    public function set_cell2(Request $request, JSONcontroller $JSON)
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
