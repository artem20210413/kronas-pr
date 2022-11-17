<?php

namespace App\Http\Controllers\Web\Decor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\JSONcontroller;
use App\Http\Requests\DecorRequest;
use App\Models\Decor;
use App\Models\TypeMaterialModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class WebTypeMaterialController extends Controller
{

    public function TypeMaterialCreate(Request $request)//TypeMaterialRequest $TMR
    {
        try {
            $vId = $request->post('id');
            $vName = $request->post('tm_name');
            if ($vName == null) {
                return (new JSONcontroller())->JSONerror('Нічого не передали або немає аргумента `tm_name`', 401);
            } else if ($vId == null || $vId == 0) {
                if (TypeMaterialModel::all()->where('tm_name', $vName)->first() == null) {
                    $decor = new TypeMaterialModel();
                    $decor->tm_name = $vName;
                    $decor->save();
                    $vNewDecor = DB::table('type_material')->latest('id')->first();
                    return (new JSONcontroller())->JSONsuccessArray('Create', 'New type material', $vNewDecor, 200);
                } else {
                    return (new JSONcontroller())->JSONerror('Назва декора: `' . $vName . '` вже існує', 501);
                }
            } else {
                $ts = TypeMaterialModel::find($vId);
                if ($ts == null) {
                    return (new JSONcontroller())->JSONerror('Елемента з id: ' . $vId . ' не існує', 501);
                }
                if (TypeMaterialModel::all()->where('tm_name', $vName)->first() == null) {
                    $ts->update($request->all());
                    //dd($decor);
                    $vUpdateDecor = DB::table('type_material')->where('id', $vId)->get();
                    return (new JSONcontroller())->JSONsuccessArray('Update', 'Type material', $vUpdateDecor, 201);
                } else {
                    return (new JSONcontroller())->JSONerror('Назва декора: `' . $vName . '` вже існує', 501);
                }
            }

        } catch (\Exception $e) {
            return (new JSONcontroller())->JSONerror($e->getMessage(), 501);
        }
    }

    public function GetCreateTypeMaterial($id, $tmName)
    {
return view('type_material_CU', ['id' => $id,'tmName'=>$tmName]);

    }

    public function TypeMaterialGet(Request $request)
    {
        try {
            $vName = $request->get('tm_name');
            if ($vName == null) {
                $GetTM = TypeMaterialModel::all();
            } else {
                $GetTM = DB::table('type_material')->where('tm_name', 'like', "%" . $vName . "%")->get();
            }
            return view('type_material', ['TM' => $GetTM, 'tmname' => $vName]);
        } catch (\Exception $e) {
            return (new JSONcontroller())->JSONerror($e->getMessage(), 501);
        }
    }

    public function TypeMaterialDestroy($vId)
    {
        try {
            if ($vId != null) {

                $res = TypeMaterialModel::destroy($vId);

                if ($res != 0) {
                    return $res;
                    // return (new TypeMaterialModel())->JSONsuccess('Успішно видалений елемент з id=' . $vId, 202);
                } else {
                    return (new JSONcontroller())->JSONerror('Елемент з id=' . $vId . ' не видален, він відсутній або сталася помилка', 401);
                }
            } else {

                return (new JSONcontroller())->JSONerror('Відсутнє обов`язкове поле `id`', 401);
            }
        } catch (\Exception $e) {
            return (new JSONcontroller())->JSONerror($e->getMessage(), 501);
        }
    }
}
