<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeMaterialRequest;
use App\Models\TypeMaterialModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TypeMaterialController extends Controller
{
    public function TypeMaterialCreate(TypeMaterialRequest $TMR, JSONcontroller $JSON)
    {
        try {
            $TM = new TypeMaterialModel();
            $TM->name = $TMR->input('name');
            $TM->save();
            return $JSON->JSONsuccess('Успіх', 201);
        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }

    }

    public function TypeMaterialGet(Request $request, JSONcontroller $JSON)
    {
        $TM = new TypeMaterialModel();
        try {
            try {
                $request->validate([
                    'name' => 'required'
                ]);

            } catch (\Exception $e) {
                return $JSON->JSONsuccessArray('Get  all', 'Cell', $TM::all(), 200);
            }

            $GetTM = $TM::whereLike('type_material', '%' . $request->input('name') . '%');

            return $JSON->JSONsuccessArray('Get  name by like `'. $request->input('name') .'`',
                'Type material',
                $GetTM,
                200);

        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }

    }
    public function TypeMaterialDestroy(Request $request, JSONcontroller $JSON)
    {
        try {
            $res = TypeMaterialModel::destroy($request->get('ids'));
            return $JSON->JSONsuccess('Cells deleted!' . $res . ' el', 200);

        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
    }

}
