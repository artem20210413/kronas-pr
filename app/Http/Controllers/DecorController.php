<?php

namespace App\Http\Controllers;

use App\Http\Requests\DecorRequest;
use App\Models\Decor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DecorController extends Controller
{
    public function CreateDecor(DecorRequest $request, JSONcontroller $JSON)
    {
        try {

            $decor = new Decor();
            $decor->name = $request->input('name');
            $decor->save();
            return $JSON->JSONsuccess('Успіх', 201);

        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
    }
    public function DecorGet(Request $request, JSONcontroller $JSON)
    {

        try {
            $TM = new Decor(); //model
            try {
                $request->validate([
                    'name' => 'required'
                ]);

            } catch (\Exception $e) {
                return $JSON->JSONsuccessArray('Get  all', 'Decor', $TM::all(), 200);
            }

            $GetTM = $TM::whereLike('decor', '%' . $request->input('name') . '%');

            return $JSON->JSONsuccessArray('Get name by like `'. $request->input('name') .'`',
                'Decor',
                $GetTM,
                200);

        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
    }

    public function DecorDestroy(DecorRequest $request, JSONcontroller $JSON)
    {
        try {
            $res = Decor::destroy($request->get('ids'));
            return $JSON->JSONsuccess('Cells deleted!' . $res . ' el', 200);

        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
    }
}
