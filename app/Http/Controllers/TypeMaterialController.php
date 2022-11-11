<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeMaterialRequest;
use App\Models\TypeMaterialModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeMaterialController extends Controller
{
    public function TypeMaterialCreate(Request $request, JSONcontroller $JSON)//TypeMaterialRequest $TMR
    {
        try {
            $vId = $request->post('id');
            $vName = $request->post('tm_name');
            if ($vName == null) {
                return $JSON->JSONerror('Нічого не передали або немає аргумента `tm_name`', 401);
            } else if ($vId == null || $vId == 0) {
                $decor = new TypeMaterialModel();
                $decor->tm_name = $vName;
                $decor->save();
                $vNewDecor = DB::table('type_material')->latest('id')->first();
                return $JSON->JSONsuccessArray('Create', 'New type material', $vNewDecor, 201);
            } else {

                $ts = TypeMaterialModel::find($vId);
                if ($ts == null) {
                    return $JSON->JSONerror('Елемента з id: ' . $vId . ' не існує', 501);
                }
                $ts->update($request->all());
                //dd($decor);
                $vUpdateDecor = DB::table('type_material')->where('id', $vId)->get();
                return $JSON->JSONsuccessArray('Update', 'Type material', $vUpdateDecor, 201);
            }

        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
    }

//        try {
//            $TM = new TypeMaterialModel();
//            $TM->name = $TMR->input('name');
//            $TM->save();
//            return $JSON->JSONsuccess('Успіх', 201);
//        } catch (\Exception $e) {
//            return $JSON->JSONerror($e->getMessage(), 501);
//        }


    public function TypeMaterialGet(Request $request, JSONcontroller $JSON)
    {

        try {
            $vName = $request->get('tm_name');
            if ($vName == null) {
                $decor = new TypeMaterialModel(); //model
                return $JSON->JSONsuccessArray('Get  all', 'Decor', $decor::all(), 200);
            } else {
                $GetTM = DB::table('type_material')->where('tm_name', 'like', "%" .$vName . "%")->get();
                return $JSON->JSONsuccessArray('Get name by like ' . $vName . '',
                    'Decor',
                    $GetTM,
                    200);
            }
        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
//        $TM = new TypeMaterialModel();
//        try {
//            try {
//                $request->validate([
//                    'name' => 'required'
//                ]);
//
//            } catch (\Exception $e) {
//                return $JSON->JSONsuccessArray('Get  all', 'Cell', $TM::all(), 200);
//            }
//
//            $GetTM = $TM::whereLike('type_material', '%' . $request->input('name') . '%');
//
//            return $JSON->JSONsuccessArray('Get  name by like `'. $request->input('name') .'`',
//                'Type material',
//                $GetTM,
//                200);
//
//        } catch (\Exception $e) {
//            return $JSON->JSONerror($e->getMessage(), 501);
//        }

    }

    public function TypeMaterialDestroy(Request $request, JSONcontroller $JSON)
    {

        try {
            $vId = $request->get('id');
            if ($vId != null) {

                $res = TypeMaterialModel::destroy($request->get('id'));
                if ($res != 0) {
                    return $JSON->JSONsuccess('Успішно видалений елемент з id=' . $vId, 200);
                } else {
                    return $JSON->JSONerror('Елемент з id=' . $vId . ' не видален, він відсутній або сталася помилка', 401);
                }
            } else return $JSON->JSONerror('Відсутнє обов`язкове поле `id`', 401);

        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
//        try {
//            $res = TypeMaterialModel::destroy($request->get('ids'));
//            return $JSON->JSONsuccess('Cells deleted!' . $res . ' el', 200);
//
//        } catch (\Exception $e) {
//            return $JSON->JSONerror($e->getMessage(), 501);
//        }
    }

}
