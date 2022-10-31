<?php

namespace App\Http\Controllers;

use App\Models\Cell;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class CellController extends Controller
{
    public function set_cell(Request $request, JSONcontroller $JSON)
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

           $gg = DB::select('SELECT * FROM `cell`');
            dd($gg);
            $review = new Cell();
            $review->rack = $request->input('rack');
            $review->storey = $request->input('storey');
            $review->row = $request->input('row');
            $review->save();

            return $JSON->JSONsuccess('Поле успішно додано.',201);




        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 400);
        }
    }
}
