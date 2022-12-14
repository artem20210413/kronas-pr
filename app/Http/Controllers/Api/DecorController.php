<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\JSONcontroller;
use App\Http\Requests\DecorRequest;
use App\Models\Decor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class DecorController extends Controller
{

    public function DecorCreateAndUpdate(Request $request, JSONcontroller $JSON)
    {
        try {
            $vId = $request->post('id');
            $vName = $request->post('decor_name');
            if ($vName == null) {
                return $JSON->JSONerror('Nothing passed or no `decor_name` argument', 401);
            } else if ($vId == null || $vId == 0) {
                if (Decor::all()->where('decor_name', $vName)->first() == null) {
                    $decor = new Decor();
                    $decor->decor_name = $vName;
                    $decor->save();
                    $vNewDecor = DB::table('decor')->latest('id')->first();
                    return $JSON->JSONsuccessArray('Create', 'New decor', $vNewDecor, 201);
                } else {
                    return $JSON->JSONerror('Decor name: `' . $vName . '` already exists', 405);
                }
            } else {

                $decor = Decor::find($vId);
                if ($decor == null) {
                    return $JSON->JSONerror('Element with id: ' . $vId . ' does not exist', 405);
                }
                if (Decor::all()->where('decor_name', $vName)->first() == null) {
                    $decor->update($request->all());
                    $vUpdateDecor = DB::table('decor')->where('id', $vId)->get();
                    return $JSON->JSONsuccessArray('Update', 'Decor', $vUpdateDecor, 201);
                } else {
                    return $JSON->JSONerror('Decor name: `' . $vName . '` already exists', 405);
                }
            }
        } catch
        (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
    }

    public function DecorGet(Request $request, JSONcontroller $JSON)
    {
        try {
            $vName = $request->get('decor_name');
            $vId = $request->get('id');
            if ($vName == null && $vId == null) {
                $decor = new Decor(); //model

                return $JSON->JSONsuccessArray('Get  all', 'Decor', $decor::all(), 200);
            } else {
                //$GetTM = "";
                if ($vName == null) {
                    $GetTM = DB::table('decor')->where('id', 'like', "%" . $vId . "%")->get();
                } else {
                    $GetTM = DB::table('decor')->where('decor_name', 'like', "%" . $vName . "%")->get();
                }
                return $JSON->JSONsuccessArray('Get name by like ' . $vName = $request->get('decor_name') . '',
                    'Decor',
                    $GetTM,
                    200);
            }

        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
    }

    public function DecorDestroy(DecorRequest $request, JSONcontroller $JSON)
    {
        try {
            $vId = $request->post('id');
            if ($vId != null) {
                $res = Decor::destroy($vId);
                if ($res != 0) {
                    return $JSON->JSONsuccess('?????????????? ?????????????????? ?????????????? ?? id=' . $vId, 200);
                } else {
                    return $JSON->JSONerror('?????????????? ?? id=' . $vId . ' ???? ??????????????, ?????? ?????????????????? ?????? ?????????????? ??????????????', 401);
                }
            } else return $JSON->JSONerror('???????????????? ????????`???????????? ???????? `id`', 401);

        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
    }
}
