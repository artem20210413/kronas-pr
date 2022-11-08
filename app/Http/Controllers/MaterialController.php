<?php

namespace App\Http\Controllers;

use App\Models\MaterialModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    function empty($string): string
    {
        if ($string != null)
            return  ' '.$string;
        else
            return '';


    }

    public function MaterialGet(Request $request, JSONcontroller $JSON)
    {
        try {
            $vId = $request->get('id');
            $vVendor_code = $request->get('vendor_code');
            $vType_material_id = $request->get('type_material_id');
            $vDecor_id = $request->get('decor_id');
            $vCell_id = $request->get('cell_id');
            $vLength = $request->get('length');
            $vWidth = $request->get('width');
            $vThickness = $request->get('thickness');
            $vCreated_at = $request->get('created_at');
            $vUpdated_at = $request->get('updated_at');
            $vAccounting = $request->get('accounting');

            if ($vId == null && $vVendor_code == null && $vType_material_id == null && $vDecor_id == null && $vCell_id == null && $vLength == null && $vWidth == null && $vThickness == null && $vCreated_at == null && $vUpdated_at == null && $vAccounting == null) {
                $material = new MaterialModel(); //model
                return $JSON->JSONsuccessArray('Get  all', 'Material', $material::all(), 200);
            } else {
                $GetTM = DB::table('material')
                    ->where('id', 'like', "%" . $vId . "%")
                    ->where('vendor_code', 'like', "%" . $vVendor_code . "%")
                    ->where('type_material_id', 'like', "%" . $vType_material_id . "%")
                    ->where('decor_id', 'like', "%" . $vDecor_id . "%")
                    ->where('cell_id', 'like', "%" . $vCell_id . "%")
                    ->where('length', 'like', "%" . $vLength . "%")
                    ->where('width', 'like', "%" . $vWidth . "%")
                    ->where('thickness', 'like', "%" . $vThickness . "%")
                    ->where('created_at', 'like', "%" . $vCreated_at . "%")
                    ->where('updated_at', 'like', "%" . $vUpdated_at . "%")
                    ->where('accounting', 'like', "%" . $vAccounting . "%")
                    ->get();
                return $JSON->JSONsuccessArray('Get name by like var',
                    'Decor',
                    $GetTM,
                    200);
            }


//            if ($vName == null) {
//                $decor = new MaterialModel(); //model
//                return $JSON->JSONsuccessArray('Get  all', 'Decor', $decor::all(), 200);
//            } else {
//
//                $GetTM = DB::table('material')->where('name', 'like', "%" . $request->get('name') . "%")->get();
//                return $JSON->JSONsuccessArray('Get name by like ' . $request->input('name') . '',
//                    'Decor',
//                    $GetTM,
//                    200);
//            }
        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
//        dd(MaterialModel::all());

    }
}
