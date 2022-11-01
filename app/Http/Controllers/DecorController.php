<?php

namespace App\Http\Controllers;

use App\Http\Requests\DecorRequest;
use App\Models\Decor;
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
    public function DeleteDecor(DecorRequest $request, JSONcontroller $JSON)
    {
        try {
            $res = Decor::destroy($request->get('ids'));
            return $JSON->JSONsuccess('Cells deleted!' . $res . ' el', 200);

        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
    }
}
