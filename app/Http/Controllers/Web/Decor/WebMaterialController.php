<?php

namespace App\Http\Controllers\Web\Decor;


use App\Http\Controllers\Api\JSONcontroller;
use App\Http\Controllers\Controller;
use App\Models\Cell;
use App\Models\MaterialModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebMaterialController extends Controller
{

    private function getMaterial($decor, $tm){
//        $Ms =  MaterialModel::all();
        //$Ms =  MaterialModel::where('id', '<>', 0)->get();
        $decor = '%'.$decor.'%';
        //$tm = '%'. trim($tm) .'%';
        $tm = '%'.$tm .'%';
        $M = DB::select("CALL material_by('". $decor ."', '". $tm ."');");
        return $M;
    }

    public function index(Request $request, JSONcontroller $JSON)
    {
        try {
            $vId = $request->get('id');
            $vVendor_code = $request->get('vendor_code');
            $vType_material = $request->get('type_material');
            $vDecor = $request->get('decor');
            $vCell = $request->get('cell');
            $vLength = $request->get('length');
            $vWidth = $request->get('width');
            $vThickness = $request->get('thickness');
            $vCreated_at = $request->get('created_at');
            $vUpdated_at = $request->get('updated_at');
            $vAccounting = $request->get('accounting');
            $vStorageCode = $request->get('storage_code');
            $material_call =  $this->getMaterial($vDecor, $vType_material);
            if ($vId == null && $vVendor_code == null && $vType_material == null && $vDecor == null && $vCell == null
                && $vLength == null && $vWidth == null && $vThickness == null && $vCreated_at == null && $vUpdated_at == null && $vAccounting == null && $vStorageCode == null) {
                $material = new MaterialModel(); //model
                $GetTM = $material::all();
//                $m = MaterialModel::all();
                $m = MaterialModel::where('id', '<>', 0);

                foreach ($request->all() as $key => $req) {
                    if ($key == 'length' || $key == 'width' || $key == 'thickness' || $key == 'created_at' || $key == 'updated_at') {
                        $m->where($key, 'like', "%" . $req . "%");
                    } else {
                        $m->where($key, $req);
                    }
                }

                $GetTM = $m->get();
                return view('production_material', ['M' => $material_call, 'request' => $request]);
            }
        } catch (\Exception $e) {
            return $JSON->JSONerror($e->getMessage(), 501);
        }
    }
}
